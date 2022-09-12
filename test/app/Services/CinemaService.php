<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.2020
 * Time: 12:59
 */

namespace App\Services;


use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaService
{
    protected $tutor;
    public function __construct(Cinema $cinema)
    {
        $this->cinema = $cinema;
    }

    public function getAll()
    {
        return $this->cinema->all();
    }

    public function add(array $request)
    {
        $cinema = $this->tutor->fill([
            'name'        => $request['name'],
            'rate'        => $request['rate'],
            'subject'     => $request['subject'],
            'experience'  => $request['experience']
        ]);

        return $cinema;
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function update(array $request)
    {
        $tutor = $this->tutor->find($request['id'])->update([
            'name'        => $request['name'],
            'rate'        => $request['rate'],
            'subject'     => $request['subject'],
            'experience'  => $request['experience']
        ]);

        return $tutor;
    }

    /**
     * @param Request $request
     * @return int
     */
    public function delete(Request $request)
    {
        $tutor = $this->tutor->destroy($request['id']);

        return $tutor;
    }
}