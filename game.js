// game.js - Full implementation of Pairs Game Logic with Emoji Assets and Difficulty Levels

document.addEventListener("DOMContentLoaded", () => {
    const gameBoard = document.getElementById("game-board");
    const startButton = document.getElementById("start-game");
    const difficultySelect = document.getElementById("difficulty");
    const scoreForm = document.getElementById("score-form");
    const scoreInput = document.getElementById("score");
    let attempts = 0;
    let matchedSets = 0;
    let flippedCards = [];
    let cardSet = [];
    let currentLevel = 1;

    const emojiParts = {
        skin: ["green.png", "red.png", "yellow.png"],
        eyes: ["closed.png", "laughing.png", "long.png", "normal.png", "rolling.png", "winking.png"],
        mouth: ["open.png", "sad.png", "smiling.png", "straight.png", "surprise.png", "teeth.png"]
    };

    // Shuffle an array
    function shuffle(array) {
        return array.sort(() => Math.random() - 0.5);
    }

    // Generate randomized emoji combinations
    function generateEmojiSet(pairs) {
        const emojis = [];
        for (let i = 0; i < pairs; i++) {
            const emoji = {
                skin: emojiParts.skin[Math.floor(Math.random() * emojiParts.skin.length)],
                eyes: emojiParts.eyes[Math.floor(Math.random() * emojiParts.eyes.length)],
                mouth: emojiParts.mouth[Math.floor(Math.random() * emojiParts.mouth.length)]
            };
            emojis.push(emoji, emoji);  // Create matching pairs
        }
        return shuffle(emojis);
    }

    // Initialize the game board
    function initializeGame() {
        gameBoard.innerHTML = "";
        scoreForm.style.display = "none";
        attempts = 0;
        matchedSets = 0;
        flippedCards = [];

        let pairs;
        if (difficultySelect.value === "simple") pairs = 3;
        else if (difficultySelect.value === "medium") pairs = 5;
        else pairs = 2 + currentLevel;  // Complex mode, pairs increase per level

        cardSet = generateEmojiSet(pairs);

        cardSet.forEach((emoji, index) => {
            const card = document.createElement("div");
            card.classList.add("card");
            card.dataset.index = index;
            card.dataset.emoji = JSON.stringify(emoji);
            card.innerHTML = "?";
            card.addEventListener("click", flipCard);
            gameBoard.appendChild(card);
        });
    }

    // Handle card flipping logic
    function flipCard() {
        if (!this.classList.contains("flipped") && flippedCards.length < 2) {
            this.classList.add("flipped");
            const emoji = JSON.parse(this.dataset.emoji);
            this.innerHTML = `
                <img src='assets/emoji assets/skin/${emoji.skin}' style='width:50px;'>
                <img src='assets/emoji assets/eyes/${emoji.eyes}' style='width:50px;'>
                <img src='assets/emoji assets/mouth/${emoji.mouth}' style='width:50px;'>
            `;
            flippedCards.push(this);

            if (flippedCards.length === 2) {
                setTimeout(checkMatch, 1000);
            }
        }
    }

    // Check if flipped cards match
    function checkMatch() {
        attempts++;
        const [card1, card2] = flippedCards;

        if (card1.dataset.emoji === card2.dataset.emoji) {
            matchedSets++;
            flippedCards = [];

            if (matchedSets === cardSet.length / 2) {
                if (difficultySelect.value === "complex" && currentLevel < 4) {
                    alert(`Great! Level ${currentLevel} completed. Starting next level.`);
                    currentLevel++;
                    initializeGame();
                } else {
                    alert(`Congratulations! You completed the game in ${attempts} attempts!`);
                    scoreInput.value = attempts;
                    scoreForm.style.display = "block";
                    currentLevel = 1;  // Reset for next game
                }
            }
        } else {
            card1.classList.remove("flipped");
            card2.classList.remove("flipped");
            card1.innerHTML = "?";
            card2.innerHTML = "?";
            flippedCards = [];
        }
    }

    // Start game event
    startButton.addEventListener("click", () => {
        currentLevel = 1;  // Reset the current level when restarting
        initializeGame();
        startButton.style.display = "none";
    });
});
