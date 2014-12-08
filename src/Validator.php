<?php

namespace NYTimes;


abstract class Validator
{
    /* --- Search Term --- */

    //@TODO should probably expand this more...
    public function searchTerm($searchTerm)
    {
        if (!is_string($searchTerm)) {
            throw new \InvalidArgumentException(
                "The query entered was not a string. \n
                You entered: $searchTerm"
            );
        }
    }
}
