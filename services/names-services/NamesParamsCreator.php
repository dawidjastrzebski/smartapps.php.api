<?php
  class NamesParamsCreator {
        public function CreateParams($params) {
            $queryParams = ' WHERE dateReleased= "2021-01-31"';
            $parameterNo = 0;
            if(!empty($params->firstLetter) and $params->firstLetter!="all")
            $queryParams = $queryParams.' AND name COLLATE utf8_polish_ci LIKE "'.$params->firstLetter.'%"';       

            if(!empty($params->gender))
            $queryParams = $queryParams.' AND gender LIKE "'.$params->gender.'"';
            
            if(!empty($params->maxLength))
            $queryParams = $queryParams.' AND  CHAR_LENGTH(name) <='.$params->maxLength;      

            if(!empty($params->minLength))
            $queryParams = $queryParams.' AND  CHAR_LENGTH(name) >='.$params->minLength;  

            if(!empty($params->topX))
            $queryParams = $queryParams.' ORDER BY numberOfOccurances DESC LIMIT '.$params->topX; 

            if(!empty($params->maxPopularity))
            $queryParams = $queryParams.' AND numberOfOccurances <= '.$params->maxPopularity; 

            if(!empty($params->minPopularity))
            $queryParams = $queryParams.' AND numberOfOccurances >= '.$params->minPopularity; 

            return $queryParams;
        }
  }