 <?php 

                    $file = 'files/card_template.csv';
                    header('Content-Type: text/csv');
                    header('Content-Disposition: attachment; filename="card_template.csv"');
                    readfile($file);

                    ?>