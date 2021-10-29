<?php
	
use App\Models\CLub_league;
	
	
	if(!function_exists('define_club_leagues'))
	{
		function define_club_leagues($leagues_id, $clubs_id, $status, $value)
		{
			// ---------------------------- INITIALIZE
				$isi 		= '';

				$model 		= Club_league::where('leagues_id', '=', $leagues_id)
										->where('clubs_id', '=', $clubs_id)
										->first();
				$goals_home_min = 0;  
				$goals_home_avg = 0;  
				$goals_home_max = 0;  
				$goals_away_min = 0;  
				$goals_away_avg = 0;  
				$goals_away_max = 0;  

				$corners_home_min = 0;  
				$corners_home_avg = 0;  
				$corners_home_max = 0;  
				$corners_away_min = 0;  
				$corners_away_avg = 0;  
				$corners_away_max = 0;  

				$yellow_cards_home_min = 0;  
				$yellow_cards_home_avg = 0;  
				$yellow_cards_home_max = 0;  
				$yellow_cards_away_min = 0;  
				$yellow_cards_away_avg = 0;  
				$yellow_cards_away_max = 0;  

				$red_cards_home_min = 0;  
				$red_cards_home_avg = 0;  
				$red_cards_home_max = 0;  
				$red_cards_away_min = 0;  
				$red_cards_away_avg = 0;  
				$red_cards_away_max = 0;  

				$home_corner_club = '';
				$away_corner_club = '';

				if(isset($model->goals_home_min)) { $goals_home_min = $model->goals_home_min; }	
				if(isset($model->goals_home_avg)) { $goals_home_avg = $model->goals_home_avg; }	
				if(isset($model->goals_home_max)) { $goals_home_max = $model->goals_home_max; }	

				if(isset($model->goals_away_min)) { $goals_away_min = $model->goals_away_min; }	
				if(isset($model->goals_away_avg)) { $goals_away_avg = $model->goals_away_avg; }	
				if(isset($model->goals_away_max)) { $goals_away_max = $model->goals_away_max; }	

				if(isset($model->corners_home_min)) { $corners_home_min = $model->corners_home_min; }	
				if(isset($model->corners_home_avg)) { $corners_home_avg = $model->corners_home_avg; }	
				if(isset($model->corners_home_max)) { $corners_home_max = $model->corners_home_max; }	

				if(isset($model->corners_away_min)) { $corners_away_min = $model->corners_away_min; }	
				if(isset($model->corners_away_avg)) { $corners_away_avg = $model->corners_away_avg; }	
				if(isset($model->corners_away_max)) { $corners_away_max = $model->corners_away_max; }	

				if(isset($model->yellow_cards_home_min)) { $yellow_cards_home_min = $model->yellow_cards_home_min; }	
				if(isset($model->yellow_cards_home_avg)) { $yellow_cards_home_avg = $model->yellow_cards_home_avg; }	
				if(isset($model->yellow_cards_home_max)) { $yellow_cards_home_max = $model->yellow_cards_home_max; }	

				if(isset($model->yellow_cards_away_min)) { $yellow_cards_away_min = $model->yellow_cards_away_min; }	
				if(isset($model->yellow_cards_away_avg)) { $yellow_cards_away_avg = $model->yellow_cards_away_avg; }
				if(isset($model->yellow_cards_away_max)) { $yellow_cards_away_max = $model->yellow_cards_away_max; }

				if(isset($model->red_cards_home_min)) { $red_cards_home_min = $model->red_cards_home_min; }	
				if(isset($model->red_cards_home_avg)) { $red_cards_home_avg = $model->red_cards_home_avg; }	
				if(isset($model->red_cards_home_max)) { $red_cards_home_max = $model->red_cards_home_max; }	

				if(isset($model->red_cards_away_min)) { $red_cards_away_min = $model->red_cards_away_min; }	
				if(isset($model->red_cards_away_avg)) { $red_cards_away_avg = $model->red_cards_away_avg; }	
				if(isset($model->red_cards_away_max)) { $red_cards_away_max = $model->red_cards_away_max; }	

				if(isset($model->home_corner_club)) { $home_corner_club = $model->home_corner_club; }
				if(isset($model->away_corner_club)) { $away_corner_club = $model->away_corner_club; }	


			// ---------------------------- ACTION 
				if($value == 'avg_goals')
				{
					if($status == 'home')
					{
						$isi 	.= '<br/><br/>H : ';
						$isi 	.= $goals_home_min.' - '.
									number_format($goals_home_avg,2,",",".").' - '.
									$goals_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $goals_away_min.' - '.
									number_format($goals_away_avg,2,",",".").' - '.
									$goals_away_max;
						$isi 	.= '<hr/>';
					}
					elseif($status == 'away')
					{
						$isi 	.= '<br/><br/>H : ';
						$isi 	.= $goals_home_min.' - '.
									number_format($goals_home_avg,2,",",".").' - '.
									$goals_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $goals_away_min.' - '.
									number_format($goals_away_avg,2,",",".").' - '.
									$goals_away_max;
						$isi 	.= '<hr/>';
					}
				}
				elseif($value == 'goals')
				{
					if($status == 'home')
					{
						$isi 	.= 'H : ';
						$isi 	.= $goals_home_min.' - '.
									number_format($goals_home_avg,2,",",".").' - '.
									$goals_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $goals_away_min.' - '.
									number_format($goals_away_avg,2,",",".").' - '.
									$goals_away_max;
					}
					elseif($status == 'away')
					{
						$isi 	.= 'H : ';
						$isi 	.= $goals_home_min.' - '.
									number_format($goals_home_avg,2,",",".").' - '.
									$goals_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $goals_away_min.' - '.
									number_format($goals_away_avg,2,",",".").' - '.
									$goals_away_max;
					}
				}
				elseif($value == 'avg_corners')
				{
					if($status == 'home')
					{
						$isi 	.= '<br/><br/><br/>H '.$home_corner_club.' : ';
						$isi 	.= $corners_home_min.' - '.
									number_format($corners_home_avg,2,",",".").' - '.
									$corners_home_max;

						$isi 	.= '<br/>A '.$away_corner_club.' : ';
						$isi 	.= $corners_away_min.' - '.
									number_format($corners_away_avg,2,",",".").' - '.
									$corners_away_max;
						$isi 	.= '<hr/>';
					}
					elseif($status == 'away')
					{
						$isi 	.= '<br/><br/><br/>H '.$home_corner_club.' : ';
						$isi 	.= $corners_home_min.' - '.
									number_format($corners_home_avg,2,",",".").' - '.
									$corners_home_max;

						$isi 	.= '<br/>A '.$away_corner_club.' : ';
						$isi 	.= $corners_away_min.' - '.
									number_format($corners_away_avg,2,",",".").' - '.
									$corners_away_max;
						$isi 	.= '<hr/>';
					}
				}
				elseif($value == 'corners')
				{
					if($status == 'home')
					{
						$isi 	.= '<br/>H '.$home_corner_club.' : ';
						$isi 	.= $corners_home_min.' - '.
									number_format($corners_home_avg,2,",",".").' - '.
									$corners_home_max;

						$isi 	.= '<br/>A '.$away_corner_club.' : ';
						$isi 	.= $corners_away_min.' - '.
									number_format($corners_away_avg,2,",",".").' - '.
									$corners_away_max;
						$isi 	.= '<hr/>';
					}
					elseif($status == 'away')
					{
						$isi 	.= '<br/>H '.$home_corner_club.' : ';
						$isi 	.= $corners_home_min.' - '.
									number_format($corners_home_avg,2,",",".").' - '.
									$corners_home_max;

						$isi 	.= '<br/>A '.$away_corner_club.' : ';
						$isi 	.= $corners_away_min.' - '.
									number_format($corners_away_avg,2,",",".").' - '.
									$corners_away_max;
						$isi 	.= '<hr/>';
					}
				}
				elseif($value == 'avg_yellow_cards')
				{
					if($status == 'home')
					{
						$isi 	.= 'H : ';
						$isi 	.= $yellow_cards_home_min.' - '.
									number_format($yellow_cards_home_avg,2,",",".").' - '.
									$yellow_cards_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $yellow_cards_away_min.' - '.
									number_format($yellow_cards_away_avg,2,",",".").' - '.
									$yellow_cards_away_max;
						$isi 	.= '<hr/>';
					}
					elseif($status == 'away')
					{
						$isi 	.= 'H : ';
						$isi 	.= $yellow_cards_home_min.' - '.
									number_format($yellow_cards_home_avg,2,",",".").' - '.
									$yellow_cards_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $yellow_cards_away_min.' - '.
									number_format($yellow_cards_away_avg,2,",",".").' - '.
									$yellow_cards_away_max;
						$isi 	.= '<hr/>';
					}
				}
				elseif($value == 'avg_red_cards')
				{
					if($status == 'home')
					{
						$isi 	.= 'H : ';
						$isi 	.= $red_cards_home_min.' - '.
									number_format($red_cards_home_avg,2,",",".").' - '.
									$red_cards_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $red_cards_away_min.' - '.
									number_format($red_cards_away_avg,2,",",".").' - '.
									$red_cards_away_max;
						$isi 	.= '<hr/>';
					}
					elseif($status == 'away')
					{
						$isi 	.= 'H : ';
						$isi 	.= $red_cards_home_min.' - '.
									number_format($red_cards_home_avg,2,",",".").' - '.
									$red_cards_home_max;

						$isi 	.= '<br/>A : ';
						$isi 	.= $red_cards_away_min.' - '.
									number_format($red_cards_away_avg,2,",",".").' - '.
									$red_cards_away_max;
						$isi 	.= '<hr/>';
					}
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('corner_fav_icon'))
	{
		function corner_fav_icon($id)
		{
			// ---------------------------- INITIALIZE
				$isi 		= '';

			// ---------------------------- ACTION  
                if($id == 1)
                {
                    $isi = '<i class="ion-ios-arrow-dropdown"></i>';
                }
                elseif($id == 2)
                {
                    $isi = '<i class="ion-ios-arrow-dropup"></i>';
                }
                elseif($id == 3)
                {
                    $isi = '<i class="ion ion-ios-radio-button-off"></i>';
                }

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}
