 <?php 

header('Content-Type: application/json');
include 'config.php';


// $test = "Select * from soccer_db.player_stats";
// $result = $conn->query($test);
// var_dump($result);
// die();


// //https://fantasy.premierleague.com/drf/element-summary/269
// https://fantasy.premierleague.com/drf/bootstrap-static

// Db Script

// CREATE TABLE `soccer_db`.`player_stats` ( `Id` INT(4) NOT NULL , `first_name` VARCHAR(255) NOT NULL , `last_name` VARCHAR(255) NOT NULL , `complete_name` VARCHAR(255) NOT NULL , `player_percentage` VARCHAR(255) NOT NULL , `avg_ppg` VARCHAR(255) NOT NULL , `minutes_played` INT(4) NOT NULL , `goals` INT(4) NOT NULL , `assists` INT(4) NOT NULL , `clean_sheets` INT(4) NOT NULL , `goals_conceded` INT(4) NOT NULL , `own_goals` INT(4) NOT NULL , `penalties_saved` INT(4) NOT NULL , `penalties_missed` INT(4) NOT NULL , `yellow_cards` INT(4) NOT NULL , `red_cards` INT(4) NOT NULL , `saves` INT(4) NOT NULL , `influence` VARCHAR(255) NOT NULL , `creativity` VARCHAR(255) NOT NULL , `threat` VARCHAR(255) NOT NULL , `team_id` INT(4) NOT NULL , `team` VARCHAR(255) NOT NULL , `stadium` VARCHAR(255) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;

$commands = file_get_contents('soccer_db.sql');
// $conn->multi_query($commands);   

if ($conn->multi_query($commands)) {
    do {
        /* store first result set */
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
}

$url = 'https://fantasy.premierleague.com/drf/elements/';

$cURL = curl_init();

curl_setopt($cURL, CURLOPT_URL, $url);
curl_setopt($cURL, CURLOPT_HTTPGET, true);
curl_setopt($cURL, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36");
curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($cURL);

$result = json_decode($result);

// Loop through starting from 1
 // var_dump($result[183]);

 // die();
// Build an array for the teams and stadium
$teams = array();
array_push($teams,"Arsenal,Emirates Stadium","Bournemouth,Vitality Stadium","Burnley,Turf Moor",
	"Chelsea,Stamford Bridge","Crystal Palace,Selhurst Park","Everton,Goodison Park","Hull City,KCOM Stadium",
	"Leceister Stadium,King Power Stadium","Liverpool,Anfield","Manchester City, Etihad Stadium","Manchester United, Old Trafford",
	"Middlesbrough,Riverside Stadium","Southampton,St Mary's Stadium","Stoke City, bet365 Stadium","Sunderland,Stadium of Light",
	"Swansea City,Liberty Stadium","Tottenham Stadium,White Hart Lane","Watford,Vicarage Road", "West Bromwich Albion,The Hawthorns",
	"West Ham United,London Stadium");


// Create your json array to store the data

$data = array();

for($i = 0 ; $i < count($result) ; $i++) 
{

	$data[$i]["id"] = $result[$i]->id;
	$data[$i]["first_name"] = $result[$i]->first_name;
	$data[$i]["last_name"] = $result[$i]->second_name;
	$data[$i]["complete_name"] = $result[$i]->first_name . " " . $result[$i]->second_name;
	$data[$i]["selected_percentage"] = $result[$i]->selected_by_percent;
	$data[$i]["avg_points_per_game"] = $result[$i]->points_per_game;
	$data[$i]["minutes_played"] = $result[$i]->minutes;
	$data[$i]["goals"] = $result[$i]->goals_scored;
	$data[$i]["assists"] = $result[$i]->assists;
	$data[$i]["clean_sheets"] = $result[$i]->clean_sheets;
	$data[$i]["goals_conceded"] = $result[$i]->goals_conceded;
	$data[$i]["own_goals"] = $result[$i]->own_goals;
	$data[$i]["penalties_saved"] = $result[$i]->penalties_saved;
	$data[$i]["penalties_missed"] = $result[$i]->penalties_missed;
	$data[$i]["yellow_cards"] = $result[$i]->yellow_cards;
	$data[$i]["red_cards"] = $result[$i]->red_cards;
	$data[$i]["saves"] = $result[$i]->saves;
	$data[$i]["influence_score"] = $result[$i]->influence;
	$data[$i]["creativity_score"] = $result[$i]->creativity;
	$data[$i]["threat_score"] = $result[$i]->threat;
	$data[$i]["team_id"] = $result[$i]->team;
	// Split team and stadium data
	$team_stadium = explode(",", $teams[($result[$i]->team) - 1]);
	// Store team name
	$team = $team_stadium[0];
	// Store stadium name
	$stadium = $team_stadium[1];
	// Fill in the team and stadium information
	$data[$i]["team"] = $team;
	$data[$i]["stadium"] = $stadium;
	
	$insert_sql_query = "INSERT INTO soccer_db." . "player_stats VALUES (" . 
			$data[$i]["id"] . ", " .
			"'{$data[$i]["first_name"]}'" . ", " .
			"'{$data[$i]["last_name"]}'" . ", " .
			"'{$data[$i]["complete_name"]}'" . ", " .
			"'{$data[$i]["selected_percentage"]}'" . ", " .
			"'{$data[$i]["avg_points_per_game"]}'" . ", " .
			$data[$i]["minutes_played"] . ", " .
			$data[$i]["goals"] . ", " .
			$data[$i]["assists"] . ", " .
			$data[$i]["clean_sheets"] . ", " .
			$data[$i]["goals_conceded"] . ", " .
			$data[$i]["own_goals"] . ", " .
			$data[$i]["penalties_saved"] . ", " .
			$data[$i]["penalties_missed"] . ", " .
			$data[$i]["yellow_cards"] . ", " .
			$data[$i]["red_cards"] . ", " .
			$data[$i]["saves"] . ", " .
			"'{$data[$i]["influence_score"]}'" . ", " .
			"'{$data[$i]["creativity_score"]}'" . ", " .
			"'{$data[$i]["threat_score"]}'" . ", " .
			$data[$i]["team_id"] . ", " .
			"'{$data[$i]["team"]}'" . ", " .
			"'{$data[$i]["stadium"]}'" .
			")";
 			$insert_result = $conn->query($insert_sql_query);	 
}


echo json_encode($data, JSON_PRETTY_PRINT);

// print_r($result);

// Build Insert statement 




?>