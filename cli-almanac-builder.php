<?php
    
    function logging( string $msg ) {
        
        echo '[' . date( 'm/d/Y H:i:s' ) . '] ' . $msg . PHP_EOL;
        
    }
    
    function run( int $year ) {
        
        logging( 'fetch holiday data' );
        
        $holidays = json_decode( file_get_contents( __DIR__ . '/config/holiday.json' ), true );
        
        $holiday_days = $holidays['discrete'];
        
        foreach( $holidays['range'] as $range ) {
            
            for( $i = strtotime( $range['from'] ); $i <= strtotime( $range['to'] ); $i += 86400 ) {
                
                $holiday_days[] = date( 'Y-m-d', $i );
                
            }
            
        }
        
        logging( 'build almanac for year ' . $year );
        
        for( $page = 0; $page <= 1; $page++ ) {
            
            $pageno = $page + 1;
            
            logging( 'build page ' . $pageno . ' of 2' );
            
            $title = $year . ' &ndash; page ' . $pageno . '/2';
            $content = '';
            
            for( $month = $page * 6 + 1; $month <= $page * 1 + 7; $month++ ) {
                
                $the_month = mktime( 0, 0, 0, $month, 1, $year );
                $month_name = date( 'F', $the_month );
                
                logging( 'build month ' . $month_name . ' of ' . $year );
                
                $content .= '<month ' . strtolower( $month_name ) . '>' .
                    '<h2>' . $month_name . '</h2>';
                
                for( $day = 1; $day <= date( 't', $the_month ); $day++ ) {
                    
                    $the_day = mktime( 0, 0, 0, $month, $day, $year );
                    $week_day = date( 'l', $the_day );
                    
                    $content .= '<day ' . strtolower( $week_day ) . (
                        in_array( date( 'Y-m-d', $the_day ), $holiday_days )
                            ? ' holiday' : ''
                    ) . '>' .
                        '<number>' . date( 'd', $the_day ) . '</number>' .
                        ( $week_day == 'Monday' ? '<week>' . date( 'W', $the_day ) . '</week>' : '' ) .
                    '</day>';
                    
                }
                
                $content .= '</month>';
                
            }
            
            logging( 'output page ' . $pageno );
            
            $output = str_replace(
                [ '[TITLE]', '[CONTENT]' ],
                [ $title, $content ],
                file_get_contents( 'template.html' )
            );
            
            file_put_contents(
                'output/' . $year . '-' . $pageno . '.html',
                $output
            );
            
        }
        
    }
    
    if( isset( $argv[1] ) && preg_match( '/^([0-9]{4})$/', $argv[1] ) )
        run( $argv[1] );
    
    else die( 'Requires parameter 1 as numieric year, e.g. 2010' );
    
?>
