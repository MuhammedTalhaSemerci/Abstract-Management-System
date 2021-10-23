<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    

    <?php
    
        for($i=0;$i<count($admin_all_abstracts);$i++)
        {
            $abstract_category_char = mb_strtoupper($admin_all_abstracts[$i][17][0]);
            if(strpos($admin_all_abstracts[$i][12],"-"))
            {
                $abstract_type_char = mb_strtoupper($admin_all_abstracts[$i][12][strpos($admin_all_abstracts[$i][12],"-")+1]);
            }
            else
            {
                $abstract_type_char = mb_strtoupper($admin_all_abstracts[$i][12][0]);
            }
            $last_abstract_no = intval($admin_all_abstracts[$i][13]);
    
            $all_authors_arr = explode(", ",$admin_all_abstracts[$i][11]);

            for($a=0;$a<count($all_authors_arr);$a++)
            {
                echo '<p style="text-align:center;"><font color="red">'.$abstract_category_char.$abstract_type_char.$last_abstract_no.'</font>:'.$all_authors_arr[$a].'</p>';
            }
        }

    ?>

</body>
</html>