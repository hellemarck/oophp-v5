<?php

namespace Mh\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller for the Movie Database
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;


    public function indexAction() : string
    {
        return $this->app->response->redirect("movie/show-all");
    }


    // Route to show all movies in database.
    public function showAllAction()
    {
        $title = "Movie database | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";

        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("movie/show-all", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to search for a movie title.
    public function searchTitleAction()
    {
        $title = "Title search | oophp";

        $this->app->db->connect();

        $movieTitle = $this->app->request->getGet("doSearch");

        if ($movieTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $res = $this->app->db->executeFetchAll($sql, ["%$movieTitle%"]);
        }

        $data = [
            "resultset" => $res ?? null
        ];

        $this->app->page->add("movie/search-title", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
    //
    // //Search based on year.
    public function searchYearAction()
    {
        $title = "Year search | oophp";

        $this->app->db->connect();

        $year1 = $this->app->request->getGet("year1");
        $year2 = $this->app->request->getGet("year2");

        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $res = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $res = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $res = $this->app->db->executeFetchAll($sql, [$year2]);
        }

        $data = [
            "resultset" => $res ?? null
        ];

        $this->app->page->add("movie/search-year", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to select a movie to edit or delete
    public function movieSelectActionGet() : object
    {
        $title = "Movie database | oophp";

        $this->app->db->connect();
        $sql = "SELECT id, title FROM movie;";

        // $movies = $this->app->db->executeFetchAll($sql);
        $data = [
            "movies" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("movie/movie-select", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Add movie
     */
    public function addMovieAction()
    {
        $title = "Add movie | oophp";

        // $this->app->db->connect();
        $this->app->page->add("movie/movie-add");

        return $this->app->page->render([
            "title" => $title,
        ]);;
    }

    /**
     * route to edit movie
     */
    public function editMovieAction()
    {
        $title = "Edit movie | oophp";

        $this->app->db->connect();
        $movieId = $this->app->request->getPost("movieId");

        if ($movieId) {
            $sql = "SELECT * FROM movie WHERE id LIKE ?;";
            $res = $this->app->db->executeFetchAll($sql, [$movieId]);
        }

        $data = [
            "movie" => $res ?? null
        ];

        $this->app->page->add("movie/movie-edit", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);;
    }

    /**
     * saving changes for a movie
     */
    public function saveChangesAction()
    {
        $this->app->db->connect();
        $id = $this->app->request->getPost("movieId");
        $title = $this->app->request->getPost("movieTitle");
        $year = $this->app->request->getPost("movieYear");
        $img = $this->app->request->getPost("movieImage");
        $doSave = $this->app->request->getPost("doSave");
        $doAdd = $this->app->request->getPost("doAdd");

        if ($doSave) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$title, $year, $img, $id]);
        }
        return $this->app->response->redirect("movie/show-all");
    }

    /**
     * adding a new movie
     */
    public function saveNewMovieAction()
    {
        $this->app->db->connect();
        $title = $this->app->request->getGet("title");
        $year = $this->app->request->getGet("year");
        $img = $this->app->request->getGet("img");
        $doAdd = $this->app->request->getGet("doAdd");

        if ($doAdd) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->execute($sql, [$title, $year, $img]);
        }
        return $this->app->response->redirect("movie/show-all");
    }

    /**
     * deleting a movie
     */
    public function deleteMovieAction()
    {
        $this->app->db->connect();
        $id = $this->app->request->getPost("movieId");
        $doDelete = $this->app->request->getPost("doDelete");

        if ($doDelete) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$id]);
        }
        return $this->app->response->redirect("movie/show-all");
    }
}
