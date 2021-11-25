<?php
    
    function run( int $year ) {
        
        for( $page = 0; $page <= 1; $page++ ) {
            
            $title = $year . ', page ' . ( $page + 1 );
            $content = '';
            
            for( $month = $page * 6 + 1; $month <= $page * 1 + 7; $month++ ) {
                
                $the_month = mktime( 0, 0, 0, $month, 1, $year );
                $month_name = date( 'F', $the_month );
                
                $content .= '<month ' . strtolower( $month_name ) . '>' .
                    '<name>' . $month_name . '</name>' .
                    '<days>';
                
                for( $day = 1; $day <= date( 't', $the_month ); $day++ ) {
                    
                    $the_day = mktime( 0, 0, 0, $month, $day, $year );
                    
                    $content .= '<day ' . strtolower( date( 'l', $the_day ) ) . '>' .
                        '<number>' . date( 'j', $the_day ) . '</number>' .
                    '</day>';
                    
                }
                
                $content .= '</days></month>';
                
            }
            
            $output = str_replace(
                [ '[TITLE]', '[CONTENT]' ],
                [ $title, $content ],
                file_get_contents( 'template.html' )
            );
            
            file_put_contents(
                'output/' . $year . '-' . ( $page + 1 ) . '.html',
                $output
            );
            
        }
        
    }
    
    if( isset( $argv[1] ) && preg_match( '/^([0-9]{4})$/', $argv[1] ) )
        run( $argv[1] );
    
    else die( 'Requires parameter 1 as numieric year, e.g. 2010' );
    
?>
