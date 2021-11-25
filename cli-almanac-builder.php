<?php
    
    function logging( string $msg ) {
        
        echo '[' . date( 'm/d/Y H:i:s' ) . '] ' . $msg . PHP_EOL;
        
    }
    
    function run( int $year ) {
        
        logging( 'build almanac for year ' . $year . ' ...' );
        
        for( $page = 0; $page <= 1; $page++ ) {
            
            logging( 'build page ' . ( $page + 1 ) . ' of 2 ...' );
            
            $title = $year . ', page ' . ( $page + 1 );
            $content = '';
            
            for( $month = $page * 6 + 1; $month <= $page * 1 + 7; $month++ ) {
                
                $the_month = mktime( 0, 0, 0, $month, 1, $year );
                $month_name = date( 'F', $the_month );
                
                logging( 'build month ' . $month_name . ' of ' . $year . ' ...' );
                
                $content .= '<month ' . strtolower( $month_name ) . '>' .
                    '<name>' . $month_name . '</name>' .
                    '<days>';
                
                for( $day = 1; $day <= date( 't', $the_month ); $day++ ) {
                    
                    $the_day = mktime( 0, 0, 0, $month, $day, $year );
                    $week_day = date( 'l', $the_day );
                    
                    $content .= '<day ' . strtolower( $week_day ) . '>' .
                        '<number>' . date( 'j', $the_day ) . '</number>' .
                        ( $week_day == 'Monday' ? '<week>' . date( 'W', $the_day ) . '</week>' : '' ) .
                    '</day>';
                    
                }
                
                $content .= '</days></month>';
                
                logging( '... done' );
                
            }
            
            logging( '... done' );
            logging( 'output page ' . ( $page + 1 ) . ' ...' );
            
            $output = str_replace(
                [ '[TITLE]', '[CONTENT]' ],
                [ $title, $content ],
                file_get_contents( 'template.html' )
            );
            
            file_put_contents(
                'output/' . $year . '-' . ( $page + 1 ) . '.html',
                $output
            );
            
            logging( '... done' );
            
        }
        
        logging( '... done' );
        
    }
    
    if( isset( $argv[1] ) && preg_match( '/^([0-9]{4})$/', $argv[1] ) )
        run( $argv[1] );
    
    else die( 'Requires parameter 1 as numieric year, e.g. 2010' );
    
?>
