# 1.0 chess-trainer  

Just a personal project I want to work on. I will try to do all my planing inside this readme.
If you come across this repo and have some ideas on how to solve certain issues or want to collaborate on the project, feel free to contact me.

## 1.1 The Basic Idea  

The basic Idea of this project is to create an application, that lets you practice chess openings, tracks your mistakes and asks you those openings more often, that you made the most mistakes in. Just like flashcards but with a chessboard.

## 1.2 The Tech Stack  
I want to try to build the frontend of the project with VueJS and the Backend with PHP.

## 1.3 First Thoughts  

A logged in User should have two options, either to practice a specific opening or to practice random openings.

If the user chooses random openings, he will be presented an opening, that he already practiced with either white or black. He than needs to make all the correct theory moves. If he makes one wrong move, he fails the exercice and the opening will be presented to him soon again. If he makes all the right moves, it becomes less likely that he will see the same opening again soon.

If he chooses to train a specific opening and makes a mistake, the board should reset and he should have the option to try again as often as he likes.


The openings and their variations should be stored in a database. Each entry needs at least a column for the name of the variation and the correct move order which should be stored in standard algebraic notation (https://en.wikipedia.org/wiki/Algebraic_notation_(chess)).

# 2.0 Work that needs to be done  

## 2.1 The Chessboard  
Take a look at (https://chessboardjs.com/) maybe this might be an option here.
1. Build a Chessboard with VueJS  
2. Import the Chess Pieces and add them to the Board  
3. Add Drag and Drop Functionality to the Chess Pieces on the Board

## 2.2 The Game Logic  
1. Implement the game logic with chess.js  
2. Add the functionality to check for theory moves in a specific opening. (The opening moves can be passed as a string here, to test the functionality. Later they should be served by the database)

## 2.3 The User  
I need to do some more planning here.



