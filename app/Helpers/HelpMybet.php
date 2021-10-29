<?php
	
use App\Models\League;
use App\Models\Club_league;
use App\Models\Fixture;

	if(!function_exists('last_fixtures'))
	{
		function last_fixtures($leagues_id, $clubs_id)
		{
			// ---------------------------- INITIALIZE
				$isi 			= '';

				$pre_model 		= fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                        ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                            
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$clubs_id)
                                            ->where('fixtures.leagues_id',$leagues_id);

                $model      	= fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                    ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')        
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                                   
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.away_clubs_id',$clubs_id)
                                            ->where('fixtures.leagues_id',$leagues_id)
                                            ->union($pre_model)
                                            ->orderBy('round_league','Desc')
                                            ->get();

			// ---------------------------- ACTION
				if(count($model) > 0)
				{
					foreach ($model as $row)
					{
						$isi .= '
							<div class="row"> 
		                        <div class="col-md-9 text-center">
		                            <table width="100%" class="text-center">
		                                <!-- Round Leagues -->
		                                    <tr>
		                                        <td class="text-right" width="30%">
		                                        </td>
		                                        <td width="40%">
		                                            <h5>
		                                                '.$row->leagues_name.' '.$row->tahun.' - '.$row->round_league.'
		                                            </h5>
		                                            <hr/>
		                                        </td>
		                                        <td class="text-left" width="30%">
		                                        </td>
		                                    </tr>
		                                <!-- Clubs -->
		                                    <tr>
		                                        <td class="text-right">';

		                                        	if($row->home_clubs_id == $clubs_id)
		                                        	{
		                                                $isi .= '<span class="label label-dark">'
		                                                	.$row->ch_name.'</span>';
		                                        	}
		                                        	else
		                                        	{
		                                        		$isi .= $row->ch_name;
		                                        	}

		                                        	$isi .= '
		                                        </td>
		                                        <td>
		                                        </td>
		                                        <td class="text-left">';

		                                        	if($row->away_clubs_id == $clubs_id)
		                                        	{
		                                                $isi .= '<span class="label label-dark">'
		                                                	.$row->ca_name.'</span>';
		                                        	}
		                                        	else
		                                        	{
		                                        		$isi .= $row->ca_name;
		                                        	}

		                                        	$isi .= ' 
		                                        </td>
		                                    </tr>
		                                
		                                <!-- Ball Possession -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_ball_possession > $row->away_ball_possession)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_ball_possession.' %
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Ball Possession
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_ball_possession.' %
		                                            ';
		                                        
		                                            if($row->home_ball_possession < $row->away_ball_possession)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Attacks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_attacks > $row->away_attacks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_attacks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Attacks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_attacks.'
		                                            ';
		                                        
		                                            if($row->home_attacks < $row->away_attacks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Dangerous Attacks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_dangerous_attacks > $row->away_dangerous_attacks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_dangerous_attacks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Dangerous Attacks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_dangerous_attacks;
		                                        
		                                            if($row->home_dangerous_attacks < $row->away_dangerous_attacks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                            	<!-- Goals Attempts -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_goal_attempts > $row->away_goal_attempts)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_goal_attempts.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Goals Attempts
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goal_attempts;
		                                        
		                                            if($row->home_goal_attempts < $row->away_goal_attempts)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                <!-- Shots on Goals -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_shots_on_goals > $row->away_shots_on_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_shots_on_goals.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Shots on Goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_shots_on_goals;
		                                        
		                                            if($row->home_shots_on_goals < $row->away_shots_on_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Shots off Goals -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_shots_off_goals > $row->away_shots_off_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_shots_off_goals.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Shots off Goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_shots_off_goals;
		                                        
		                                            if($row->home_shots_off_goals < $row->away_shots_off_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Blocked Shots -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_blocked_shots > $row->away_blocked_shots)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_blocked_shots.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Blocked Shots
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_blocked_shots;
		                                        
		                                            if($row->home_blocked_shots < $row->away_blocked_shots)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Goal Keepersaves -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_goalkeeper_saves > $row->away_goalkeeper_saves)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_goalkeeper_saves.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Goal Keepersaves
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goalkeeper_saves;
		                                        
		                                            if($row->home_goalkeeper_saves < $row->away_goalkeeper_saves)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Total Passes -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_total_passes > $row->away_total_passes)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_total_passes.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Total Passes
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_total_passes;
		                                        
		                                            if($row->home_total_passes < $row->away_total_passes)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                
		                                <!-- Offside -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_offsides > $row->away_offsides)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_offsides.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Offside
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_offsides;
		                                        
		                                            if($row->home_offsides < $row->away_offsides)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Throw in -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_throw_in > $row->away_throw_in)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= '

		                                            '.$row->home_throw_in.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Throw in 
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_throw_in.'
		                                            ';
		                                        
		                                            if($row->home_throw_in < $row->away_throw_in)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>
		                                
		                                <!-- Goals -->
		                                    <tr>
		                                        <td class="text-right">';

		                                            if($row->home_goals > $row->away_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }

		                                            $isi .=  $row->home_goals.'
		                                        </td>
		                                        <td>
		                                            <em>
		                                                <strong>
		                                                    Goals
		                                                </strong>
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goals;
		                                            
		                                            if($row->home_goals < $row->away_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }

		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Handicap -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if(($row->home_goals + $row->home_hdp_goals)  > ($row->away_hdp_goals + $row->away_goals))
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_hdp_goals .'
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Handicap
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_hdp_goals ;
		                                        
		                                            if(($row->home_goals + $row->home_hdp_goals)  < ($row->away_hdp_goals + $row->away_goals))
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Over Under -->
		                                    <tr>
		                                        <td class="text-right">             
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Over Under '.$row->over_under_goals .'
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>

		                                <!-- Corners -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_corners > $row->away_corners)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_corners.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Corners
		                                                </strong>  
		                                            </em>                                        
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_corners;
		                                        
		                                            if($row->home_corners < $row->away_corners)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Handicap -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if(($row->home_corners + $row->home_hdp_corners) > ($row->away_corners + $row->away_hdp_corners))
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= '

		                                            '.$row->home_hdp_corners.'
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Handicap
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_hdp_corners;
		                                        
		                                            if(($row->home_corners + $row->home_hdp_corners) < ($row->away_corners + $row->away_hdp_corners))
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Over Under -->
		                                    <tr>
		                                        <td class="text-right">   

		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Over Under '.$row->over_under_corners .'
		                                            </em>
		                                        </td>
		                                        <td class="text-left">

		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>

		                            	<!-- Yellow Cards -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_yellow_cards > $row->away_yellow_cards)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_yellow_cards.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Yellow Cards
		                                                </strong>  
		                                            </em> 
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_yellow_cards;
		                                        
		                                            if($row->home_yellow_cards < $row->away_yellow_cards)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Red Cards -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_red_cards > $row->away_red_cards)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_red_cards.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Red Cards
		                                                </strong>  
		                                            </em> 
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_red_cards;
		                                        
		                                            if($row->home_red_cards < $row->away_red_cards)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                            	<!-- Fouls -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_fouls > $row->away_fouls)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_fouls.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Fouls
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_fouls;
		                                        
		                                            if($row->home_fouls < $row->away_fouls)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Tackles -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_tackles > $row->away_tackles)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_tackles.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Tackles
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_tackles.'
		                                            ';
		                                        
		                                            if($row->home_tackles < $row->away_tackles)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Free Kicks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_free_kicks > $row->away_free_kicks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_free_kicks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Free Kicks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_free_kicks;
		                                        
		                                            if($row->home_free_kicks < $row->away_free_kicks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>


		                                
		                                <!--  -->
		                                    <tr>
		                                        <td class="text-right">';
		                                            $isi .=  $row->home_wdl_goals.' 
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                home_wdl_goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_wdl_goals;
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td class="text-right">';
		                                            $isi .=  $row->home_wdl_handicap_goals.' 
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                home_wdl_handicap_goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_wdl_handicap_goals;
		                                            $isi .= '
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>
		                                    
		                                    <tr>
		                                        <td class="text-right">';
		                                            $isi .=  $row->home_wdl_corners.' 
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                home_wdl_corners
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_wdl_corners;
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                    
		                                    <tr>
		                                        <td class="text-right">';
		                                            $isi .=  $row->home_wdl_handicap_corners.' 
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                home_wdl_handicap_corners
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_wdl_handicap_corners;
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                    
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="text-right">';
		                                            $isi .=  $row->home_wdl_yellow_cards.' 
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                home_wdl_yellow_cards
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_wdl_yellow_cards;
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                    
		                                    <tr>
		                                        <td class="text-right">';
		                                            $isi .=  $row->home_wdl_red_cards.' 
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                home_wdl_red_cards
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_wdl_red_cards;
		                                            $isi .= '
		                                        </td>
		                                    </tr>







		                                <!-- Postrawmatch -->
		                                    <tr>
		                                        <td class="text-right">

		                                        </td>
		                                        <td>';

		                                        	if(!is_null($row->post_raw_text))
		                                        	{
		                                                $isi .= '
		                                                <span class="label label-primary">
			                                                <em>                                            
				                                                Postrawmatch
				                                            </em>
			                                            </span>';
		                                        	}
		                                        	$isi .= '
		                                        </td>
		                                        <td class="text-left">

		                                        </td>
		                                    </tr>
		                                
		                            </table>
		                            <hr/>
		                            <br/>
		                        </div>    
		                        <div class="col-md-3 text-center">
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <x-cv42.a-white-right link="'. route('Postmatch.edit', $row->idf) .'" icon="ion-md-create" title="Edit"/> 
		                                </div>
		                            </div>

		                            <div class="row">
		                                <div class="col-md-12">
		                                    <br/>
		                                    <br/>
		                                    <br/>';
		                                    if($row->home_win == 'Win')
		                                    {
		                                    	$isi .= 'Home Win<br/>';
		                                    }

		                                    if($row->away_win == 'Win')
		                                    {
		                                    	$isi .= 'Away Win<br/>';
		                                    }
		                                    
		                                    if($row->home_win_handicap_goals == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Handicap<br/>';
		                                    }
		                                    
		                                    if($row->away_win_handicap_goals == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Handicap<br/>';
		                                    }
		                                    
		                                    if($row->over_goals == 'Win')
		                                    {
		                                    	$isi .= 'Over Goals<br/>';
		                                    }
		                                    
		                                    if($row->under_goals == 'Win')
		                                    {
		                                    	$isi .= 'Under Goals<br/>';
		                                    }		                                    

		                                    if($row->home_win_corners == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Corners<br/>';
		                                    }
		                                    
		                                    if($row->away_win_corners == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Corners<br/>';
		                                    }
		                                    
		                                    if($row->home_win_handicap_corners == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Handicap Corners<br/>';
		                                    }
		                                    
		                                    if($row->away_win_handicap_corners == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Handicap Corners<br/>';
		                                    }
		                                    
		                                    if($row->over_corners == 'Win')
		                                    {
		                                    	$isi .= 'Over Corners<br/>';
		                                    }
		                                    
		                                    if($row->under_corners == 'Win')
		                                    {
		                                    	$isi .= 'Under Corners<br/>';
		                                    }
		                                    
		                                    $isi .= '
		                                    <br/>		                                    
		                                    Total Goals : '.$row->home_goals + $row->away_goals.'<br/><br/>
		                                    Total Corners : '.$row->home_corners + $row->away_corners.'<br/><br/>
		                                    Total Cards : '.$row->home_yellow_cards + $row->away_yellow_cards + $row->home_red_cards + $row->away_red_cards.'<br/>
		                                </div>
		                            </div>
		                        </div>  
		                    </div>
						';
					}
	            }


			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('head_to_head'))
	{
		function head_to_head($home_clubs_id, $away_clubs_id)
		{
			// ---------------------------- INITIALIZE
				$isi 			= '';

				$pre_model         = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                        ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                            
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun as tahun_liga',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$home_clubs_id)
                                            ->where('fixtures.away_clubs_id',$away_clubs_id);

        		$model      = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                    ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')        
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                                   
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun as tahun_liga',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$away_clubs_id)
                                            ->where('fixtures.away_clubs_id',$home_clubs_id)
                                            ->union($pre_model)
                                            ->orderBy('tahun_liga','Desc')
                                            ->orderBy('round_league','Desc')
                                            ->get(); 

			// ---------------------------- ACTION
				if(count($model) > 0)
				{
					foreach ($model as $row)
					{
						$isi .= '
							<div class="row"> 
		                        <div class="col-md-9 text-center">
		                            <table width="100%" class="text-center">
		                                <!-- Round Leagues -->
		                                    <tr>
		                                        <td class="text-right" width="30%">
		                                        </td>
		                                        <td width="40%">
		                                            <h5>
		                                                '.$row->leagues_name.' '.$row->tahun.' - '.$row->round_league.'
		                                            </h5>
		                                            <hr/>
		                                        </td>
		                                        <td class="text-left" width="30%">
		                                        </td>
		                                    </tr>
		                                <!-- Clubs -->
		                                    <tr>
		                                        <td class="text-right">' 
		                                        	.$row->ch_name.'
		                                        </td>
		                                        <td>
		                                        </td>
		                                        <td class="text-left">
		                                        	'
		                                        	.$row->ca_name.
		                                        	' 
		                                        </td>
		                                    </tr>
		                                
		                                <!-- Ball Possession -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_ball_possession > $row->away_ball_possession)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_ball_possession.' %
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Ball Possession
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_ball_possession.' %
		                                            ';
		                                        
		                                            if($row->home_ball_possession < $row->away_ball_possession)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Attacks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_attacks > $row->away_attacks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_attacks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Attacks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_attacks.'
		                                            ';
		                                        
		                                            if($row->home_attacks < $row->away_attacks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Dangerous Attacks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_dangerous_attacks > $row->away_dangerous_attacks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_dangerous_attacks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Dangerous Attacks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_dangerous_attacks;
		                                        
		                                            if($row->home_dangerous_attacks < $row->away_dangerous_attacks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                            	<!-- Goals Attempts -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_goal_attempts > $row->away_goal_attempts)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_goal_attempts.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Goals Attempts
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goal_attempts;
		                                        
		                                            if($row->home_goal_attempts < $row->away_goal_attempts)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                <!-- Shots on Goals -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_shots_on_goals > $row->away_shots_on_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_shots_on_goals.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Shots on Goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_shots_on_goals;
		                                        
		                                            if($row->home_shots_on_goals < $row->away_shots_on_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Shots off Goals -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_shots_off_goals > $row->away_shots_off_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_shots_off_goals.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Shots off Goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_shots_off_goals;
		                                        
		                                            if($row->home_shots_off_goals < $row->away_shots_off_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Blocked Shots -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_blocked_shots > $row->away_blocked_shots)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_blocked_shots.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Blocked Shots
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_blocked_shots;
		                                        
		                                            if($row->home_blocked_shots < $row->away_blocked_shots)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Goal Keepersaves -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_goalkeeper_saves > $row->away_goalkeeper_saves)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_goalkeeper_saves.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Goal Keepersaves
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goalkeeper_saves;
		                                        
		                                            if($row->home_goalkeeper_saves < $row->away_goalkeeper_saves)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Total Passes -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_total_passes > $row->away_total_passes)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_total_passes.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Total Passes
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_total_passes;
		                                        
		                                            if($row->home_total_passes < $row->away_total_passes)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                
		                                <!-- Offside -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_offsides > $row->away_offsides)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_offsides.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Offside
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_offsides;
		                                        
		                                            if($row->home_offsides < $row->away_offsides)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Throw in -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_throw_in > $row->away_throw_in)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= '

		                                            '.$row->home_throw_in.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Throw in 
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_throw_in.'
		                                            ';
		                                        
		                                            if($row->home_throw_in < $row->away_throw_in)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>
		                                
		                                <!-- Goals -->
		                                    <tr>
		                                        <td class="text-right">';

		                                            if($row->home_goals > $row->away_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }

		                                            $isi .=  $row->home_goals.'
		                                        </td>
		                                        <td>
		                                            <em>
		                                                <strong>
		                                                    Goals
		                                                </strong>
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goals;
		                                            
		                                            if($row->home_goals < $row->away_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }

		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Handicap -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if(($row->home_goals + $row->home_hdp_goals)  > ($row->away_hdp_goals + $row->away_goals))
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_hdp_goals .'
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Handicap
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_hdp_goals ;
		                                        
		                                            if(($row->home_goals + $row->home_hdp_goals)  < ($row->away_hdp_goals + $row->away_goals))
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Over Under -->
		                                    <tr>
		                                        <td class="text-right">             
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Over Under '.$row->over_under_goals .'
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>

		                                <!-- Corners -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_corners > $row->away_corners)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_corners.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Corners
		                                                </strong>  
		                                            </em>                                        
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_corners;
		                                        
		                                            if($row->home_corners < $row->away_corners)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Handicap -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if(($row->home_corners + $row->home_hdp_corners) > ($row->away_corners + $row->away_hdp_corners))
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= '

		                                            '.$row->home_hdp_corners.'
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Handicap
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_hdp_corners;
		                                        
		                                            if(($row->home_corners + $row->home_hdp_corners) < ($row->away_corners + $row->away_hdp_corners))
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Over Under -->
		                                    <tr>
		                                        <td class="text-right">   

		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Over Under '.$row->over_under_corners .'
		                                            </em>
		                                        </td>
		                                        <td class="text-left">

		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>

		                            	<!-- Yellow Cards -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_yellow_cards > $row->away_yellow_cards)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_yellow_cards.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Yellow Cards
		                                                </strong>  
		                                            </em> 
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_yellow_cards;
		                                        
		                                            if($row->home_yellow_cards < $row->away_yellow_cards)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Red Cards -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_red_cards > $row->away_red_cards)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_red_cards.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Red Cards
		                                                </strong>  
		                                            </em> 
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_red_cards;
		                                        
		                                            if($row->home_red_cards < $row->away_red_cards)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                            	<!-- Fouls -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_fouls > $row->away_fouls)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_fouls.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Fouls
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_fouls;
		                                        
		                                            if($row->home_fouls < $row->away_fouls)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Tackles -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_tackles > $row->away_tackles)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_tackles.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Tackles
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_tackles.'
		                                            ';
		                                        
		                                            if($row->home_tackles < $row->away_tackles)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Free Kicks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_free_kicks > $row->away_free_kicks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_free_kicks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Free Kicks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_free_kicks;
		                                        
		                                            if($row->home_free_kicks < $row->away_free_kicks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Postrawmatch -->
		                                    <tr>
		                                        <td class="text-right">

		                                        </td>
		                                        <td>';

		                                        	if(!is_null($row->post_raw_text))
		                                        	{
		                                                $isi .= '
		                                                <span class="label label-primary">
			                                                <em>                                            
				                                                Postrawmatch
				                                            </em>
			                                            </span>';
		                                        	}
		                                        	$isi .= '
		                                        </td>
		                                        <td class="text-left">

		                                        </td>
		                                    </tr>
		                                
		                            </table>
		                            <hr/>
		                            <br/>
		                        </div>    
		                        <div class="col-md-3 text-center">
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <x-cv42.a-white-right link="'. route('Postmatch.edit', $row->idf) .'" icon="ion-md-create" title="Edit"/> 
		                                </div>
		                            </div>

		                            <div class="row">
		                                <div class="col-md-12">
		                                    <br/>
		                                    <br/>
		                                    <br/>';
		                                    if($row->home_win == 'Win')
		                                    {
		                                    	$isi .= 'Home Win<br/>';
		                                    }

		                                    if($row->away_win == 'Win')
		                                    {
		                                    	$isi .= 'Away Win<br/>';
		                                    }
		                                    
		                                    if($row->home_win_handicap_goals == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Handicap<br/>';
		                                    }
		                                    
		                                    if($row->away_win_handicap_goals == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Handicap<br/>';
		                                    }
		                                    
		                                    if($row->over_goals == 'Win')
		                                    {
		                                    	$isi .= 'Over Goals<br/>';
		                                    }
		                                    
		                                    if($row->under_goals == 'Win')
		                                    {
		                                    	$isi .= 'Under Goals<br/>';
		                                    }		                                    

		                                    if($row->home_win_corners == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Corners<br/>';
		                                    }
		                                    
		                                    if($row->away_win_corners == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Corners<br/>';
		                                    }
		                                    
		                                    if($row->home_win_handicap_corners == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Handicap Corners<br/>';
		                                    }
		                                    
		                                    if($row->away_win_handicap_corners == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Handicap Corners<br/>';
		                                    }
		                                    
		                                    if($row->over_corners == 'Win')
		                                    {
		                                    	$isi .= 'Over Corners<br/>';
		                                    }
		                                    
		                                    if($row->under_corners == 'Win')
		                                    {
		                                    	$isi .= 'Under Corners<br/>';
		                                    }
		                                    
		                                    $isi .= '
		                                    <br/>		                                    
		                                    Total Goals : '.$row->home_goals + $row->away_goals.'<br/><br/>
		                                    Total Corners : '.$row->home_corners + $row->away_corners.'<br/><br/>
		                                    Total Cards : '.$row->home_yellow_cards + $row->away_yellow_cards + $row->home_red_cards + $row->away_red_cards.'<br/>
		                                </div>
		                            </div>
		                        </div>  
		                    </div>
						';
					}
	            }


			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('last_fixtures_corner'))
	{
		function last_fixtures_corner($leagues_id, $clubs_id)
		{
			// ---------------------------- INITIALIZE
				$isi 			= '';

				$pre_model 		= fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                        ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                            
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$clubs_id)
                                            ->where('fixtures.leagues_id',$leagues_id);

                $model      	= fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                    ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')        
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                                   
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.away_clubs_id',$clubs_id)
                                            ->where('fixtures.leagues_id',$leagues_id)
                                            ->union($pre_model)
                                            ->orderBy('round_league','Desc')
                                            ->get();

			// ---------------------------- ACTION
				if(count($model) > 0)
				{
					foreach ($model as $row)
					{
						$isi .= '
							<div class="row"> 
		                        <div class="col-md-9 text-center">
		                            <table width="100%" class="text-center">
		                                <!-- Round Leagues -->
		                                    <tr>
		                                        <td class="text-right" width="30%">
		                                        </td>
		                                        <td width="40%">
		                                            <h5>
		                                                '.$row->leagues_name.' '.$row->tahun.' - '.$row->round_league.'
		                                            </h5>
		                                            <hr/>
		                                        </td>
		                                        <td class="text-left" width="30%">
		                                        </td>
		                                    </tr>
		                                <!-- Clubs -->
		                                    <tr>
		                                        <td class="text-right">';

		                                        	if($row->home_clubs_id == $clubs_id)
		                                        	{
		                                                $isi .= '<span class="label label-dark">'
		                                                	.$row->ch_name.'</span>';
		                                        	}
		                                        	else
		                                        	{
		                                        		$isi .= $row->ch_name;
		                                        	}

		                                        	$isi .= '
		                                        </td>
		                                        <td>
		                                        </td>
		                                        <td class="text-left">';

		                                        	if($row->away_clubs_id == $clubs_id)
		                                        	{
		                                                $isi .= '<span class="label label-dark">'
		                                                	.$row->ca_name.'</span>';
		                                        	}
		                                        	else
		                                        	{
		                                        		$isi .= $row->ca_name;
		                                        	}

		                                        	$isi .= ' 
		                                        </td>
		                                    </tr>
		                                
		                                <!-- Ball Possession -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_ball_possession > $row->away_ball_possession)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_ball_possession.' %
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Ball Possession
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_ball_possession.' %
		                                            ';
		                                        
		                                            if($row->home_ball_possession < $row->away_ball_possession)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Attacks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_attacks > $row->away_attacks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_attacks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Attacks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_attacks.'
		                                            ';
		                                        
		                                            if($row->home_attacks < $row->away_attacks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Dangerous Attacks -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_dangerous_attacks > $row->away_dangerous_attacks)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_dangerous_attacks.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Dangerous Attacks
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_dangerous_attacks;
		                                        
		                                            if($row->home_dangerous_attacks < $row->away_dangerous_attacks)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                            	<!-- Goals Attempts -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_goal_attempts > $row->away_goal_attempts)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_goal_attempts.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Goals Attempts
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_goal_attempts;
		                                        
		                                            if($row->home_goal_attempts < $row->away_goal_attempts)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                
		                                <!-- Shots on Goals -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_shots_on_goals > $row->away_shots_on_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .=  $row->home_shots_on_goals.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Shots on Goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_shots_on_goals;
		                                        
		                                            if($row->home_shots_on_goals < $row->away_shots_on_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Shots off Goals -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_shots_off_goals > $row->away_shots_off_goals)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_shots_off_goals.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Shots off Goals
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_shots_off_goals;
		                                        
		                                            if($row->home_shots_off_goals < $row->away_shots_off_goals)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Blocked Shots -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_blocked_shots > $row->away_blocked_shots)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_blocked_shots.'
		                                        </td>
		                                        <td>
		                                            <em>                                            
		                                                Blocked Shots
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_blocked_shots;
		                                        
		                                            if($row->home_blocked_shots < $row->away_blocked_shots)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                

		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>


		                                <!-- Corners -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if($row->home_corners > $row->away_corners)
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= $row->home_corners.'
		                                        </td>
		                                        <td>
		                                            <em>       
		                                                <strong>
		                                                    Corners
		                                                </strong>  
		                                            </em>                                        
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_corners;
		                                        
		                                            if($row->home_corners < $row->away_corners)
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Handicap -->
		                                    <tr>
		                                        <td class="text-right">';
		                                        
		                                            if(($row->home_corners + $row->home_hdp_corners) > ($row->away_corners + $row->away_hdp_corners))
		                                            {
		                                                $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
		                                            }
		                                            
		                                            $isi .= '

		                                            '.$row->home_hdp_corners.'
		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Handicap
		                                            </em>
		                                        </td>
		                                        <td class="text-left">
		                                            '.$row->away_hdp_corners;
		                                        
		                                            if(($row->home_corners + $row->home_hdp_corners) < ($row->away_corners + $row->away_hdp_corners))
		                                            {
		                                                $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
		                                            }
		                                            
		                                            $isi .= '
		                                        </td>
		                                    </tr>
		                                <!-- Over Under -->
		                                    <tr>
		                                        <td class="text-right">   

		                                        </td>
		                                        <td class="text-danger">
		                                            <em>                                            
		                                                Over Under '.$row->over_under_corners .'
		                                            </em>
		                                        </td>
		                                        <td class="text-left">

		                                        </td>
		                                    </tr>
		                                
		                                    <tr>
		                                    	<td colspan="3">
		                                    		<br/>
		                                    	</td>
		                                    </tr>

		                                <!-- Postrawmatch -->
		                                    <tr>
		                                        <td class="text-right">

		                                        </td>
		                                        <td>';

		                                        	if(!is_null($row->post_raw_text))
		                                        	{
		                                                $isi .= '
		                                                <span class="label label-primary">
			                                                <em>                                            
				                                                Postrawmatch
				                                            </em>
			                                            </span>';
		                                        	}
		                                        	$isi .= '
		                                        </td>
		                                        <td class="text-left">

		                                        </td>
		                                    </tr>
		                                
		                            </table>
		                            <hr/>
		                            <br/>
		                        </div>    
		                        <div class="col-md-3 text-center">
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <x-cv42.a-white-right link="'. route('Postmatch.edit', $row->idf) .'" icon="ion-md-create" title="Edit"/> 
		                                </div>
		                            </div>

		                            <div class="row">
		                                <div class="col-md-12">
		                                    <br/>
		                                    <br/>
		                                    <br/>';
		                                    if($row->home_win == 'Win')
		                                    {
		                                    	$isi .= 'Home Win<br/>';
		                                    }

		                                    if($row->away_win == 'Win')
		                                    {
		                                    	$isi .= 'Away Win<br/>';
		                                    }
		                                    
		                                    if($row->home_win_handicap_goals == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Handicap<br/>';
		                                    }
		                                    
		                                    if($row->away_win_handicap_goals == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Handicap<br/>';
		                                    }
		                                    
		                                    if($row->over_goals == 'Win')
		                                    {
		                                    	$isi .= 'Over Goals<br/>';
		                                    }
		                                    
		                                    if($row->under_goals == 'Win')
		                                    {
		                                    	$isi .= 'Under Goals<br/>';
		                                    }		                                    

		                                    if($row->home_win_corners == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Corners<br/>';
		                                    }
		                                    
		                                    if($row->away_win_corners == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Corners<br/>';
		                                    }
		                                    
		                                    if($row->home_win_handicap_corners == 'Win')
		                                    {
		                                    	$isi .= 'Home Win Handicap Corners<br/>';
		                                    }
		                                    
		                                    if($row->away_win_handicap_corners == 'Win')
		                                    {
		                                    	$isi .= 'Away Win Handicap Corners<br/>';
		                                    }
		                                    
		                                    if($row->over_corners == 'Win')
		                                    {
		                                    	$isi .= 'Over Corners<br/>';
		                                    }
		                                    
		                                    if($row->under_corners == 'Win')
		                                    {
		                                    	$isi .= 'Under Corners<br/>';
		                                    }
		                                    
		                                    $isi .= '
		                                    <br/>		                                    
		                                    Total Goals : '.$row->home_goals + $row->away_goals.'<br/><br/>
		                                    Total Corners : '.$row->home_corners + $row->away_corners.'<br/><br/>
		                                    Total Cards : '.$row->home_yellow_cards + $row->away_yellow_cards + $row->home_red_cards + $row->away_red_cards.'<br/>
		                                </div>
		                            </div>
		                        </div>  
		                    </div>
						';
					}
	            }


			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}
	if(!function_exists('head_to_head_corner_short'))
	{
		function head_to_head_corner_short($home_clubs_id, $away_clubs_id)
		{
			// ---------------------------- INITIALIZE
				$isi 			= '';

				$pre_model         = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                        ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                            
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun as tahun_liga',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$home_clubs_id)
                                            ->where('fixtures.away_clubs_id',$away_clubs_id);

        		$model      = fixture::join('clubs as ch', 'ch.id', '=', 'fixtures.home_clubs_id')
                                    ->join('clubs as ca', 'ca.id', '=', 'fixtures.away_clubs_id')        
                                        ->join('leagues', 'leagues.id', '=', 'fixtures.leagues_id')
                                        ->select(
                                            '*',                                   
                                            DB::raw("(SELECT nama FROM bet_statuses WHERE id = fixtures.my_bet) as my_bet"),
                                            'ch.nama as ch_name',
                                            'ca.nama as ca_name',
                                            'leagues.tahun as tahun_liga',
                                            'leagues.nama as leagues_name',
                                            'fixtures.id as idf',
                                            )
                                            ->whereNotNull('fixtures.home_goals')
                                            ->whereNotNull('fixtures.away_goals')
                                            ->where('fixtures.home_clubs_id',$away_clubs_id)
                                            ->where('fixtures.away_clubs_id',$home_clubs_id)
                                            ->union($pre_model)
                                            ->orderBy('tahun_liga','Desc')
                                            ->orderBy('round_league','Desc')
                                            ->get(); 

			// ---------------------------- ACTION
				if(count($model) > 0)
				{
					foreach ($model as $row)
					{
						$isi .= $row->leagues_name.' '.$row->tahun.' - '.$row->round_league.'<br/>' 
                    			.$row->ch_name.' - '.$row->ca_name.'<br/>' ;
                    
                        if($row->home_corners > $row->away_corners)
                        {
                            $isi .= '<i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i> ';
                        }
                        
                        $isi .= $row->home_corners.' - '.$row->away_corners;
                    
                        if($row->home_corners < $row->away_corners)
                        {
                            $isi .= ' <i class="ion ion-md-arrow-dropup-circle text-success semi-bold"></i>';
                        }
                        
                        $isi .= '<br/><br/>';
					}
	            }


			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}