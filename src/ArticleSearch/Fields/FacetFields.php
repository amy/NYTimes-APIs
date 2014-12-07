<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 12/7/14
 * Time: 2:36 AM
 */

namespace NYTimes\ArticleSearch\Fields;

use Eloquent\Enumeration\AbstractEnumeration;

class FacetFields extends AbstractEnumeration
{
    const SECTION_NAME = 'section_name';
    const DOCUMENT_TYPE = 'document_type';
    const TYPE_OF_MATERIIAL = 'type_of_material';
    const SOURCE = 'source';
    const DAY_OF_WEEK = 'day_of_week';
} 