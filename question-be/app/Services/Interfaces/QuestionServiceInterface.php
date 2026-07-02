<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface QuestionServiceInterface
{
    public function getList(Request $request);
    public function getDetail(string $id);
    public function create(Request $request);
    public function update(string $id, Request $request);
    public function delete(string $id);
}