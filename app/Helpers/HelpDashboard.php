<?php
	
use App\Models\League;
use App\Models\Club_league;
use App\Models\Fixture;
use App\Models\Country;

	if(!function_exists('top_corner_club_dashboard'))
	{
		function top_corner_club_dashboard($home_corner,$away_corner,$leagues_id)
		{
			// ---------------------------- INITIALIZE
				$isi = '';

				if(!is_null($leagues_id))
				{
					$model = Club_league::join('leagues', 
										'leagues.id', '=', 'club_leagues.leagues_id')
								->join('clubs', 
										'clubs.id', '=', 'club_leagues.clubs_id')
								->select(
									'clubs.id',
									'leagues.nama as leagues_name',
									'leagues.tahun',
									'clubs.nama as clubs_name',
									// 'club_leagues.total_avg_home_corners',
									// 'club_leagues.total_avg_away_corners'
									)
								->where('leagues.id', '=', $leagues_id)
								->where('club_leagues.home_corner_club',  $home_corner)
								->where('club_leagues.away_corner_club', $away_corner)
								->orderBy('clubs.nama','asc')
								->orderBy('leagues.tahun','desc')
	                            ->get();
				}
				else
				{
					$model = Club_league::join('leagues', 
										'leagues.id', '=', 'club_leagues.leagues_id')
								->join('clubs', 
										'clubs.id', '=', 'club_leagues.clubs_id')
								->select(
									'clubs.id',
									'leagues.nama as leagues_name',
									'leagues.tahun',
									'clubs.nama as clubs_name',
									// 
									
									)
								->where('club_leagues.home_corner_club',  $home_corner)
								->where('club_leagues.away_corner_club', $away_corner)
								->orderBy('clubs.nama','asc')
								->orderBy('leagues.tahun','desc')
	                            ->get();
				}

			// ---------------------------- ACTION
				if(count($model) > 0)
				{
	            	$isi .= 
	            	'                	
		            <div class="col-md-6 col-xs-12 col-12">
		                <table class="table table-bordered widget-table widget-table-rounded">
		                    <thead>
		                        <tr class="text-center">
		                            <th rowspan="2">
		                               '.$home_corner.'
		                            </th>
		                            <th colspan="3">
		                                Home
		                            </th>
		                            <th colspan="3">
		                                Away
		                            </th>
		                        </tr>
		                        <tr>
		                            <th>
		                               Min
		                            </th>
		                            <th>
		                               Avg
		                            </th>
		                            <th>
		                               Max
		                            </th>
		                            <th>
		                               Min
		                            </th>
		                            <th>
		                               Avg
		                            </th>
		                            <th>
		                               Max
		                            </th>
		                        </tr>
		                    </thead>
		                    <tbody>';

				                foreach($model as $row)
				                {
				                	$isi .= '
			                        <tr>
			                            <td>
			                                '.$row->clubs_name.' 
			                            </td>
			                            <td class="text-center"> 
			                            </td>
			                            <td class="text-center">
			                                '.$row->total_avg_home_corners.' 
			                            </td>
			                            <td class="text-center"> 
			                            </td>
			                            <td class="text-center"> 
			                            </td>
			                            <td class="text-center">
			                                '.$row->total_avg_away_corners.' 
			                            </td>
			                            <td class="text-center"> 
			                            </td>
			                        </tr>

				                	';
				                }


		                    	$isi .= '
		                    </tbody>
		                </table>
		            </div>
	            	';
	            }


			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('country_league'))
	{
		function country_league()
		{
			// ---------------------------- INITIALIZE
				$isi = '';

				$model = Country::get();

			// ---------------------------- ACTION
				foreach ($model as $row) 
				{
			       	$isi .= '
					<div class="col-lg-3 col-md-6">
	        			<a href="'.route("Leagues.index_list",$row->id).'" target="_blank">
							<div class="widget widget-stats bg-white text-inverse">
								<div class="stats-icon stats-icon-square ">								
						            <i class="">
						                <h2 class="flag-icon flag-icon-'.$row->flag_icon.'"></h2> 
						            </i>   
						        </div>
								<div class="stats-content">
									<div class="stats-title">'.$row->nama.'</div>
									<div class="stats-number">7,842,900</div>
									<div class="stats-progress progress">
										<div class="progress-bar" style="width: 70.1%;"></div>
									</div>
									<div class="stats-desc">Better than last week (70.1%)</div>
								</div>
							</div>
						</a>  
					</div>';
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}
