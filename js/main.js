
const els = {
  score: null,
  answer: null,
  choices: null
};

const words = [
  'JAVASCRIPT',// [0]
  'STYLESHEET',// [1]
  'LANGUAGE'// [2]
];
let choices = [];

let word = "";

let wordMapping = [];
let choicesMapping = [];
let scoreCount = 0;
let maxScore = 8;

const init = () => {
  //  console.log('>> #init');

  //attach elements
  els.score = document.querySelector('#score');
  els.answer = document.querySelector('#answer');
  els.choices = document.querySelector('#choices');

  //pick word
  word = pickWord();
  //  console.log('word', word);
  //  -creat word mapping
  wordMapping = getWordMapping(word);
  console.log('wordMapping', wordMapping);

  //generate choices
  choices = generateChoices();

  //  console.log(choices);
  //  creat choices mapping (permet de manipuler mhtl a partir de js)
  choicesMapping = getChoicesMapping(choices);
  console.log(choicesMapping);
  //display word
  displayWord(wordMapping);
  //display choices
  displayChoices(choicesMapping);
  //display score (error)
 // displayScore();
  //listen to events
  //   -mousse EventSource
  
 
  els.choices.addEventListener('click', ({target}) => {
        // const value = event.target.value;
        // console.log(value);
         if(target.matches('li')){
           checkLetter(target.innerHTML);
         }
       });
  //  - keyboard events
document.addEventListener( 'keydown', ({ keyCode}) => {
//evt:keyboardEvent evt.keyCode => { keyCode }
console.log('keyCode', keyCode);
const letter = String.fromCharCode(keyCode);

console.log('letter', letter);
       if(keyCode >= 65 && keyCode<= 90 ){
           checkLetter(letter);
       }
});  //check letter
  // -if not in word:add score
  // -if in word:display letter 
  // - endGame
  //      -if score=== max loos game
  //      -if letter are visible : win game
//
    const checkLetter= (letter) =>{
    //console.log(letter);
    let isLetterInWord=false;
    let isAllLettersFound=true;
   // const element = document.getElementById(letter);
   // element.remove();
   // console.log('isLetterInWord before loop' ,isLetterInWord);
    wordMapping.forEach((letterMapping) =>{
     // console.log('letterMaping.letter', letterMapping.lettre);
        if(letterMapping.letter === letter){
            letterMapping.isVisible = true;
            isLetterInWord =true;

        }
        if (!letterMapping.isVisible){
          isAllLettersFound=false;
        }
    });  
      choicesMapping.forEach((letterMapping) => {
        if(letterMapping === letter) {
          letterMapping.isChosen=true ;
        }

      });
      displayChoices(choicesMapping);

    if (isLetterInWord === true) {
      displayWord(wordMapping);
    }else{
      scoreCount++;
      displayScore();
    }
  //  console.log('isLetterInWord afther loop ' ,isLetterInWord);

if(scoreCount === maxScore ){
  endGame();
}
if(isAllLettersFound){
  winGame();
}
};

//  console.log('isLetterInWord afther loop ' ,isLetterInWord);

};
const endGame= () => {
  wordMapping.forEach(w => w.isVisible = true);
  displayWord(wordMapping);
document.querySelector('body').style.backgroundColor='red';
els.choices.innerHTML=`<h1>You is dead, bro!</h1>`; 
};
const winGame= ()=>{
els.choices.innerHTML= alert(`You are a live`); 
};


window.addEventListener('load', () => {
  init();
});

const getRandomInt = (min, max) => {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}