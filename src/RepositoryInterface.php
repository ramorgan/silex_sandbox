<?php
/**
 * Created by PhpStorm.
 * User: reese
 * Date: 10/30/17
 * Time: 3:26 PM
 */

namespace Sandbox;


interface RepositoryInterface
{
    public function find($id);

    public function update($id);

    public function create($id);
}
