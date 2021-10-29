<?php
	
use App\Models\CLub;

	if(!function_exists('define_club'))
	{
		function define_club($name_club, $name_club2, $leagues_id)
		{
			// ---------------------------- INITIALIZE
				$isi 		= '';
		        $pre_isi    = $name_club;
		        $pre_club   = array("Manchester", 
		        				"B.", 
		        				"FC", 
		        				"AC", 
		        				"AS", 
		        				"Ath", 
		        				"Real", 
		        				"Atl.", 
		        				"St.", 
		        				"St", 
		        				"Club",
		        				"FK",
		        				"Spartak",
		        				"D.",
		        				"Olympiacos",
		        				"Slavia",
		        				"Union",
		        				"Lincoln",
		        				"AZ",
		        				"CSKA",
		        				"Maccabi",
		        				"R.",
		        				"SG"
		        			);

			// ---------------------------- ACTION            	
		        if (($name_club != $name_club2) && (in_array($name_club, $pre_club)))
		        {
		            $pre_isi   .= ' '.$name_club2;
		        }

		        if(!is_null($leagues_id))
		        {
		        	$isi = Club::join('club_leagues', 'club_leagues.clubs_id', '=', 'clubs.id')
		        			->where('clubs.nama', 'like', $pre_isi.'%')
		        			->where('club_leagues.leagues_id', $leagues_id)
		        				->value('clubs.id');
		        }
		        else
		        {
		        	$isi = Club::join('club_leagues', 'club_leagues.clubs_id', '=', 'clubs.id')
		        			->where('clubs.nama', 'like', $pre_isi.'%')
		        				->value('clubs.id');
		        }


			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}