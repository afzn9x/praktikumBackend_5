<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{

    public $animals = ['ayam', 'kambing', 'sapi'];

    function index () {
        echo 'Data Animal' . '<br>';
        $no = 1;
        foreach ($this->animals as $animal) {

            echo $no . ' ' . $animal . '<br>';
            $no++;
        };
    }

    function index_id ($id) {
        echo "Data : " . $this->animals[$id];
    }

    function create (Request $request) {
        array_push($this->animals, $request->nama);
        echo 'Create Animal';
        $this->index();
    }

    function update (Request $request, $id) {
        $this->animals[$id] = $request->nama;
        echo 'Update Animal';
        $this->index();
    }

    function destroy ($id) {
        unset($this->animals[$id]);
        echo 'Delete Animal';
        $this->index();
    }
}
