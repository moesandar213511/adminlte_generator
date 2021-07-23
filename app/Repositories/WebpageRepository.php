<?php

namespace App\Repositories;

use App\Models\Webpage;
use App\Repositories\BaseRepository;

/**
 * Class WebpageRepository
 * @package App\Repositories
 * @version December 27, 2019, 9:45 am UTC
*/

class WebpageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Webpage::class;
    }
}
