<?php

namespace App\Http\Controllers;

use App\model\Pajak;
use Illuminate\Http\Request;

class PajakController extends Controller
{
    public function getData($id)
    {
        $pajak = Pajak::find($id);

        return json_encode($pajak);
    }
}
