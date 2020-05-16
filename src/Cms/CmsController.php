<?php

namespace Mh\Cms;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

require "function.php";


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller for the Movie Database
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CmsController implements AppInjectableInterface
{
    use AppInjectableTrait;

    // index action redirect to show-all page
    public function indexAction()
    {
        return $this->app->response->redirect("cms/show-all");
    }

    // Route to show all content in database.
    public function showAllAction()
    {
        $title = "Cms";

        $this->app->db->connect();
        $sql = "SELECT * FROM content;";

        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("cms/show-all", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // Route to show admin page to CRUD.
    public function adminAction()
    {
        $title = "Cms";
        $this->app->db->connect();
        $sql = "SELECT * FROM content;";

        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("cms/admin", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // Route to create.
    public function createActionGet()
    {
        $title = "Create content";

        $this->app->page->add("cms/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // post method to create
    public function createActionPost()
    {
        $title = "Create content";
        $this->app->db->connect();

        if (hasKeyPost("doCreate")) {
            $title = $this->app->request->getPost("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);
            $id = $this->app->db->lastInsertId();

            return $this->app->response->redirect("cms/edit?id=$id");
        }
    }

    // Route to reset.
    public function resetActionGet()
    {
        $title = "Reset database";

        $this->app->page->add("cms/reset");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to view pages
    public function pagesActionGet()
    {
        $title = "View pages";
        $this->app->db->connect();
        $page = "page";

        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        // $resultset = $db->executeFetchAll($sql, [$url]);
        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql, [$page]),
            "title" => $title
        ];

        $this->app->page->add("cms/pages", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to view a page
    public function pageActionGet($path)
    {
        $title = "View page";
        $this->app->db->connect();

        // $route = $this->app->request->getGet("route", "");

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

        $resultset = $this->app->db->executeFetch($sql, [$path, "page"]);
        $data = [
            "content" => $resultset
        ];

        $this->app->page->add("cms/page", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to view blog posts
    public function blogActionGet()
    {
        $title = "View blog";
        $this->app->db->connect();

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
AND (deleted IS NULL OR deleted > NOW())
ORDER BY published DESC
;
EOD;

        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);
        $data = [
            "resultset" => $resultset
        ];

        $this->app->page->add("cms/blog", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to read blog post
    public function blogPostActionGet($slug)
    {
        $title = "View blogpost";
        $this->app->db->connect();

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;

        // var_dump($slug);

        $resultset = $this->app->db->executeFetch($sql, [$slug, "post"]);
        $data = [
            "content" => $resultset
        ];
        // var_dump($data);

        $this->app->page->add("cms/blogpost", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * CRUD METHODS
     */

    // edit pages
    public function editActionGet()
    {
        $title = "Edit content";
        $this->app->db->connect();
        $id = $this->app->request->getGet("id");
        $sql = "SELECT * FROM content WHERE id LIKE ?";

        $data = [
            "content" => $this->app->db->executeFetchAll($sql, [$id])
        ];

        $this->app->page->add("cms/edit", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // save edits
    public function editActionPost()
    {
        $title = "Edit content";
        $this->app->db->connect();
        $contentId = getPost("contentId");
        // $slugMsg = "";

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId",
            ]);

            if (!$params["contentSlug"]) {
                $params["contentSlug"] = slugify($params["contentTitle"]);
            }

            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }

            if (!$params["contentFilter"]) {
                $params["contentFilter"] = "bbcode";
            }

            // handling duplicate slugs - cannot save slug if already exists
            $currSlug = $params["contentSlug"];
            $currId = $params["contentId"];
            $slugSql = "SELECT id FROM content WHERE slug = ?;";
            $res = $this->app->db->executeFetch($slugSql, [$currSlug]);
            if ($res != null and $res->id != $currId) {
                $params["contentSlug"] = null;
            }

            $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
            $this->app->db->execute($sql, array_values($params));

            return $this->app->response->redirect("cms/edit?id=$contentId");
            return $this->app->page->render([
                "title" => $title
                // "slugMsg" => $slugMsg
            ]);
        }
    }

    // get method for delete post
    public function deleteActionGet()
    {
        $title = "Delete content";
        $this->app->db->connect();
        $id = $this->app->request->getGet("id");

        $sql = "SELECT * FROM content WHERE id LIKE ?";

        $data = [
            "content" => $this->app->db->executeFetchAll($sql, [$id])
        ];

        $this->app->page->add("cms/delete", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // post method to delete page
    public function deleteActionPost()
    {
        // $title = "Delete content | oophp";
        $this->app->db->connect();

        if (hasKeyPost("doDelete")) {
            $contentId = getPost("contentId");
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$contentId]);
            return $this->app->response->redirect("cms/admin");
        }
    }
}
