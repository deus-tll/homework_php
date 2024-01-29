<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface EntityServiceInterface
{
    /**
     * Getting all the records from database
     * @param int $page
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    function index(int $page, int $per_page)  : LengthAwarePaginator;

    /**
     * Getting 1 record from database
     * @param int $id
     * @return Model
     */
    function show(int $id) : Model;

    /**
     * Creating the record in database
     * @param Request $request
     * @return Model
     */
    function store(Request $request) : Model;

    /**
     * Updating the record in database
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function update(Request $request, int $id) : bool;

    /**
     * Deleting the record from database
     * @param int $id
     * @return void
     */
    public function destroy(int $id) : void;
}
