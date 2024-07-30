<?php
// Load and preprocess the dataset
$df = new \Ds\Vector(file('water_analysis.csv'));

// Retrieve form data
$pH = floatval($_POST['pH']);
$Salinity = floatval($_POST['Salinity']);
$Toxicity = floatval($_POST['Toxicity']);
$Alkalinity = floatval($_POST['Alkalinity']);
$Conductivity = floatval($_POST['Conductivity']);

// Preprocess the input features
$features = [$pH, $Salinity, $Toxicity, $Alkalinity, $Conductivity];
$features = array_map(function ($value) {
    return ($value - mean($df)) / stdev($df);
}, $features);

// Load the logistic regression model
$model = unserialize(file_get_contents('logistic_regression_model.bin'));

// Perform the prediction
$prediction = $model->predict([$features]);

// Generate the result message
if ($prediction == 1) {
    $result = 'The crop has normal nutritional values.';
} else {
    $result = 'The crop has high nutritional values.';
}

// Render the result
require 'result.html';
