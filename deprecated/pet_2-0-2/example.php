<?php
/* include P.E.T. class */
include_once 'pet.class.php';

/* enable exception-handling */
try {
    /* instantiate object and define template-file */
    $pet = new pet('example.html');
    
    /* substitute content-tag with content */
    $pet->my_headline = 'Let\'s count ten times from one to ten:';
    
    /* add ten repetitions of loop "outer_loop" */
    for($i = 1; $i <= 10; $i++) {
        $outerLoop = $pet->addLoop('outer_loop');
        
        /* substitute content-tag with content in "outer_loop" */
        $outerLoop->number = $i;
        
        /* add ten repetitions of loop "innerLoop" in every repetition of "outer_loop" */
        for($j = 1; $j <= 10; $j++) {
            $innerLoop = $outerLoop->addLoop('inner_loop');
            
            /* substitute content-tag with content in "inner_loop" */
            $innerLoop->number = $j;
        }
    }
    
    /* pass parsed template to browser */
    echo $pet->fetch();
    
/* catcb exceptions */    
} catch(petException $exception) {
    echo "<h1>Uh oh, something went wrong:</h1>\n";
    
    /* show error details P.E.T. provides to you */
    echo $exception->getMessage(), "<br />";
    print_r($exception->getDetails())."<br />";
    echo "in ".$exception->getFile();
    echo " on line ".$exception->getLine();
    exit;
}
?>