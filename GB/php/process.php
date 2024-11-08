<?php
$userInput = $_POST["userInput"];

// Associative array mapping user questions to bot responses
$responses = array(
    "ola" => "Bem-vindo ao Gestão de Empresas Bitrix! Sua plataforma dedicada a facilitar e otimizar a gestão de bicicletas. Seja você um entusiasta, um profissional da área ou uma empresa, estamos aqui para simplificar o controle, manutenção e logística das suas bicicletas. Prepare-se para uma jornada mais eficiente e sustentável sobre duas rodas",
    "como voce esta?" => "Estou bem, obrigado por perguntar!",
    "qual o seu nome?" => "Meu nome é ChatGPT. Eu sou um assistente virtual.",
    "quem te criou?" => "Fui criado pela OpenAI.",
    "vc pode me ajudar?" => "Claro! Estou aqui para ajudar. O que você precisa?",
    "o que voce faz?" => "Gosto de ajudar as pessoas e aprender coisas novas!",
    "qual o sentido da vida" => "Essa é uma pergunta profunda! Muitas pessoas têm diferentes pontos de vista sobre isso.",
    "onde vc mora" => "Eu existo no mundo digital, então não tenho uma localização física.",
    "me conte uma piada" => "Claro! Aqui vai uma: Por que o programador sempre confundiu o Natal com o Halloween? Porque dez 25 é igual a 31 (25 em base 10 é igual a 31 em base 8)!",
    "o que é uma ia" => "Inteligência artificial é a simulação da inteligência humana por computadores.",
    "voce é uma ia?" => "Sim, sou um assistente virtual baseado em inteligência artificial!",
);

// Check if the user's input matches any key in the responses array
$botResponse = isset($responses[$userInput]) ? $responses[$userInput] : "Desculpa. Não entendi";

// Simulate some delay for a more natural conversation
usleep(1000000);

echo $botResponse;

