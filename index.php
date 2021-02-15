<?php
//Fetching the API with user-input or displaying default 'Pikachu' when no user-input is found
$API_NAME_URL = "https://pokeapi.co/api/v2/pokemon/";

if (empty($_GET['name'])) {
    $_GET['name'] = 'pikachu';
    $input_url = $API_NAME_URL . $_GET['name'];
} else {
    $input_url = $API_NAME_URL . $_GET['name'];
}
$json_data = json_decode(file_get_contents($input_url), true);

//Getting pokemon's ID + name
$data_id = $json_data['id'];
$data_name = $json_data['name'];
$pokeImage = $json_data['sprites']['front_default'];

//Getting the Pokemon's moves
$movesArr = [];
$pokeMoves = $json_data['moves'];
for ($i = 0; $i < 4; $i++) {
    $moves = $pokeMoves[$i]['move']['name'];
    $movesArr[] = $moves;
    list($a, $b, $c, $d) = $movesArr;
}

//Getting name +  image FOR PREVIOUS evolution
$species_URL = $json_data['species']['url'];
$json_species = json_decode(file_get_contents($species_URL), true);
$evolution_chain_URL = $json_species['evolution_chain']['url'];
$json_evolution_chain = json_decode(file_get_contents($evolution_chain_URL), true);
$evolves_to_1 = $json_evolution_chain['chain']['evolves_to']['0']['species'];
$evolves_to_2 = $json_evolution_chain['chain']['evolves_to']['0']['evolves_to']['0']['species'];
$evolve_from = $json_evolution_chain['chain']['species'];

if (empty($json_evolution_chain['chain']['evolves_to'])) {
    $evolves_from_name = $evolve_from['name'];
    $evolves_from_URL = $evolve_from['url'];
    $json_evolves_from = json_decode(file_get_contents($evolves_from_URL), true);
    $image_evolves_from_URL = $json_evolves_from['varieties']['0']['pokemon']['url'];

    $json_image_from = json_decode(file_get_contents($image_evolves_from_URL), true);
    $image_evolves_from = $json_image_from['sprites']['front_default'];

    } else if ($data_name == "eevee" | $data_id == '133'){
    $evolves_eevee_1_name = $evolves_to_1['name'];
    $evolves_eevee_1_URL = $evolves_to_1['url'];
    $evolves_eevee_5_name = $json_evolution_chain['chain']['evolves_to']['5']['species']['name'];
    $evolves_eevee_5_URL = $json_evolution_chain['chain']['evolves_to']['5']['species']['url'];
    $evolves_eevee_6_name = $json_evolution_chain['chain']['evolves_to']['6']['species']['name'];
    $evolves_eevee_6_URL = $json_evolution_chain['chain']['evolves_to']['6']['species']['url'];

    $json_evolves_eevee = json_decode(file_get_contents($evolves_eevee_1_URL), true);
    $image_evolves_eevee_1_URL = $json_evolves_eevee['varieties']['0']['pokemon']['url'];
    $json_image_eevee = json_decode(file_get_contents($image_evolves_eevee_1_URL), true);
    $image_evolves_eevee_1 = $json_image_eevee['sprites']['front_default'];

    $json_evolves_eevee = json_decode(file_get_contents($evolves_eevee_5_URL), true);
    $image_evolves_eevee_5_URL = $json_evolves_eevee['varieties']['0']['pokemon']['url'];
    $json_image_eevee_5 = json_decode(file_get_contents($image_evolves_eevee_5_URL), true);
    $image_evolves_eevee_5 = $json_image_eevee_5['sprites']['front_default'];

    $json_evolves_eevee_6 = json_decode(file_get_contents($evolves_eevee_6_URL), true);
    $image_evolves_eevee_6_URL = $json_evolves_eevee_6['varieties']['0']['pokemon']['url'];
    $json_image_eevee_6 = json_decode(file_get_contents($image_evolves_eevee_6_URL), true);
    $image_evolves_eevee_6 = $json_image_eevee_6['sprites']['front_default'];

    $evolves_from_name = $evolves_eevee_1_name;
    $evolves_to_1_name = $evolves_eevee_5_name;
    $evolves_to_2_name = $evolves_eevee_6_name;
    $image_evolves_from = $image_evolves_eevee_1;
    $image_evolves_to_1 = $image_evolves_eevee_5;
    $image_evolves_to_2 = $image_evolves_eevee_6;


}
    else if (empty($json_evolution_chain['chain']['evolves_to']['0']['evolves_to'])){
        $evolves_to_1_name = $evolves_to_1['name'];
        $evolves_to_1_URL = $evolves_to_1['url'];
        $json_evolves_to_1 = json_decode(file_get_contents($evolves_to_1_URL), true);
        $image_evolves_to_URL_1 = $json_evolves_to_1['varieties']['0']['pokemon']['url'];

        $json_image_to_1 = json_decode(file_get_contents($image_evolves_to_URL_1), true);
        $image_evolves_to_1 = $json_image_to_1['sprites']['front_default'];

        $evolves_from_name = $evolve_from['name'];
        $evolves_from_URL = $evolve_from['url'];
        $json_evolves_from = json_decode(file_get_contents($evolves_from_URL), true);
        $image_evolves_from_URL = $json_evolves_from['varieties']['0']['pokemon']['url'];

        $json_image_from = json_decode(file_get_contents($image_evolves_from_URL), true);
        $image_evolves_from = $json_image_from['sprites']['front_default'];

} else {
    $evolves_to_2_name = $evolves_to_2['name'];
    $evolves_to_2_URL = $evolves_to_2['url'];

    $json_evolves_to_2 = json_decode(file_get_contents($evolves_to_2_URL), true);
    $image_evolves_to_URL_2 = $json_evolves_to_2['varieties']['0']['pokemon']['url'];
    $json_image_to_2 = json_decode(file_get_contents($image_evolves_to_URL_2), true);
    $image_evolves_to_2 = $json_image_to_2['sprites']['front_default'];

    $evolves_to_1_name = $evolves_to_1['name'];
    $evolves_to_1_URL = $evolves_to_1['url'];
    $json_evolves_to_1 = json_decode(file_get_contents($evolves_to_1_URL), true);
    $image_evolves_to_URL_1 = $json_evolves_to_1['varieties']['0']['pokemon']['url'];

    $json_image_to_1 = json_decode(file_get_contents($image_evolves_to_URL_1), true);
    $image_evolves_to_1 = $json_image_to_1['sprites']['front_default'];

    $evolves_from_name = $evolve_from['name'];
    $evolves_from_URL = $evolve_from['url'];
    $json_evolves_from = json_decode(file_get_contents($evolves_from_URL), true);
    $image_evolves_from_URL = $json_evolves_from['varieties']['0']['pokemon']['url'];

    $json_image_from = json_decode(file_get_contents($image_evolves_from_URL), true);
    $image_evolves_from = $json_image_from['sprites']['front_default'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex</title>
    <link rel="stylesheet" href="pokedex.css">
</head>
<body>
<div class="grid-container">
    <div class="grid-item">
        <div class="inputbox"><p>Look for your Pokemon by name or ID: </p>
            <form method="get"><input type="text" id="poke-name" name="name"/></form>
        </div>
    </div>
    <div class="grid-item">
        <div class="sprite">
            <img src="<?php echo $pokeImage ?>" alt="pokemon image" id="poke-photo"/>
        </div>
        <img id="pokedex" src="pokedex.png" alt="pokedex"/>
        <div class="moves"
             id="poke-moves"><h4><?php echo "Moves:" . "</br></br>" . $a . "</br>" . $b . "</br>" . $c . "</br>" . $d ?></h4>
            <template id="template">
                <li class="move"></li>
            </template>
            <ol id="target"></ol>
        </div>

        <div class="evoluti">
            <h4><?php echo "Evolution:" . "</br>" . $evolves_from_name . " " . " " . $evolves_to_1_name . " " . $evolves_to_2_name ?></h4>
            <span id="poke-evolution"><img src="<?php echo $image_evolves_from ?>" id="poke_evolve_from" alt=""/><img
                        src="<?php echo $image_evolves_to_1 ?>" id="poke_evolve_from" alt=""/><img
                        src="<?php echo $image_evolves_to_2 ?>" id="poke_evolve_from" alt=""/></span></div>
        <div class="poke_id" id="poke-ID">ID & Name:<?php echo "</br></br>" . $data_id . " " . $data_name ?></div>
    </div>

</div>
<!--<script src="pokedex.js/"></script>-->
</body>
</html>
