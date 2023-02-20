
const displayScore = () => {
    els.score.innerHTML = `${scoreCount} / ${maxScore}`;
    els.score.innerHTML = `<div style="margin: 0 auto;"><img src="../images/pendu${scoreCount}.jpg"  alt="hangam" /></div>`
};

const displayChoices = (choicesMapping) => {
    //console.log("HELLO FROM DISPLAY CHOICE")
    const choicesHtml = choicesMapping.map((letterMapping) => 
        `<li id='${letterMapping.letter}'>${letterMapping.letter}</li>`
    );
    els.choices.querySelector('ul').innerHTML = choicesHtml.join('');
};

const displayWord = (wordMapping) => {
    const wordHtml = wordMapping.map((letterMapping, i) => {
       // console.log("HELLO FROM DISPLAY WORD")
        if (letterMapping.isVisible === true) {
            return `<li id='${"selection" + i}'>${letterMapping.letter}</li>`;
        } else {
            return `<li>_</li>`;
        }

    });
    els.answer.querySelector('ul').innerHTML = wordHtml.join('');
};


const generateChoices = () => {
    const choices = [];
    for (let index = 65; index <= 90; index++) {
        choices.push(String.fromCharCode(index));
    }
    return choices;
};
const getChoicesMapping = (choices) => {
    const choicesMapping = choices.map((letter) => {
        return {
            letter,
            isChosen: false
        };
    });
    return choicesMapping;
};

const getWordMapping = (word) => {
    const wordArr = word.split('');
    // console.log("word" , word);
    //console.log('wordArr',wordArr );
    const wordMapping = wordArr.map((letter, index) => {
        let isVisible = false;
        if (index == 0 || index == wordArr.length - 1) {
            isVisible = true
        }

        return {
            letter,
            isVisible
        };

    });


    return wordMapping;
};

//generate choices
choices = generateChoices();


const pickWord = () => {
    const randomIndex = getRandomInt(0, words.length - 1);

    return words[randomIndex];

};