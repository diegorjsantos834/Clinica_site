<?php
// Este arquivo guarda as OPÇÕES PREDEFINIDAS que aparecem nos formulários.
// Assim, o médico e a especialidade não são digitados, e sim escolhidos em um <select>.

// $medicos é um ARRAY ASSOCIATIVO: cada médico (chave) aponta para a sua especialidade (valor).
// Essa relação é usada para, ao escolher o médico, preencher a especialidade automaticamente.
$medicos = [
    'Dr. Carlos Almeida' => 'Dermatologia',
    'Dra. Fernanda Lima' => 'Cardiologia',
    'Dr. Rafael Costa' => 'Ortopedia',
    'Dra. Renata Oliveira' => 'Pediatria',
    'Dr. Bruno Martins' => 'Neurologia',
    'Dra. Juliana Rocha' => 'Ginecologia',
    'Dr. André Pereira' => 'Clínico Geral',
];

// $especialidades é um array simples (só uma lista de valores).
// Ele também lista as opções da especialidade, caso o usuário queira trocar depois do médico.
$especialidades = [
    'Cardiologia',
    'Dermatologia',
    'Pediatria',
    'Ortopedia',
    'Neurologia',
    'Ginecologia',
    'Oftalmologia',
    'Clínico Geral',
];