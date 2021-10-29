<?php
	
use App\Models\League;
use App\Models\Club_league;
use App\Models\Fixture;
use App\Models\Club;

	if(!function_exists('round_league'))
	{
		function round_league($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = 0;

				//  Round

			// ---------------------------- ACTION
				$temp 	= explode("//Round//", $raw_text);

				if(count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					if($value == 'Round' && count($temp) > 1)
					{
						$isi 	= $temp2[0];
					}
					/*
					elseif($value == 'League' && count($temp) > 1)
					{
						$temp3 	= explode('Football', $temp[0]);
						$temp4  = str_replace('//', '', $temp3[1]);
						$temp5  = str_replace('-', '', $temp3[1]);
						$temp6  = explode(':', $temp5);

						$isi 	= $temp6[1];
					}
					*/
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('club'))
	{
		function club($raw_text, $value, $leagues_id)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

				//  Finished

			// ---------------------------- ACTION
				$temp 	= explode("//Finished//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);

					$isi = define_club($temp2[0], $temp2[1], $leagues_id);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi = define_club($temp2[0], $temp2[1], $leagues_id);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('goals'))
	{
		function goals($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

				//  Ball Possession 

			// ---------------------------- ACTION
				$temp 	= explode("//Finished//", $raw_text);
				$temp2 	= explode('//', $temp[0]);

				if($value == 'Home' && count($temp) > 1)
				{
					if(count($temp2) >= 5)
					{
						$isi 	= $temp2[2];
					}
					else
					{
						$isi 	= $temp2[1];
					}
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					if(count($temp2) >= 5)
					{
						$isi 	= $temp2[4];
					}
					else
					{
						$isi 	= $temp2[3];
					}
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('ball_possession'))
	{
		function ball_possession($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

				//  Ball Possession 

			// ---------------------------- ACTION
				$temp = explode("//Ball//Possession//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('%', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('%', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('goal_attempts'))
	{
		function goal_attempts($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Goal//Attempts//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('shots_on_goal'))
	{
		function shots_on_goal($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Shots//on//Goal//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('shots_off_goal'))
	{
		function shots_off_goal($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Shots//off//Goal//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('blocked_shots'))
	{
		function blocked_shots($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Blocked//Shots//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('free_kicks'))
	{
		function free_kicks($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Free//Kicks//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('corner_kicks'))
	{
		function corner_kicks($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Corner//Kicks//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('offsides'))
	{
		function offsides($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Offsides//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('throw_in'))
	{
		function throw_in($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Throw-in//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('goalkeeper_saves'))
	{
		function goalkeeper_saves($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Goalkeeper//Saves//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('fouls'))
	{
		function fouls($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Fouls//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('total_passes'))
	{
		function total_passes($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Total//Passes//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('completed_passes'))
	{
		function completed_passes($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Completed//Passes//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('red_cards'))
	{
		function red_cards($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Red//Cards//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{	
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('yellow_cards'))
	{
		function yellow_cards($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Yellow//Cards//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{	
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('tackles'))
	{
		function tackles($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Tackles//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('attacks'))
	{
		function attacks($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Attacks//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}

	if(!function_exists('dangerous_attacks'))
	{
		function dangerous_attacks($raw_text, $value)
		{
			// ---------------------------- INITIALIZE
				$isi = Null;

			// ---------------------------- ACTION
				$temp = explode("//Dangerous//Attacks//", $raw_text);

				if($value == 'Home' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[0]);
					$temp3 	= substr($temp[0],-3);

					$isi 	= str_replace('/', '', $temp3);
				}
				elseif($value == 'Away' && count($temp) > 1)
				{
					$temp2 	= explode('//', $temp[1]);

					$isi 	= str_replace('/', '', $temp2[0]);
				}

			// ---------------------------- SEND
				return $isi;

			// ///////////////////////////////////////
		}
	}
