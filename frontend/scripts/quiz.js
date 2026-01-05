document.addEventListener('DOMContentLoaded', function() {
    let questionCount = document.querySelectorAll('.inner-container .medium-green-title:not(#title)').length;
    
    // Add Question functionality
    const addQuestionBtn = document.getElementById('add-question-btn');
    if (addQuestionBtn) {
        addQuestionBtn.addEventListener('click', function (e) {
            e.preventDefault();
            addNewQuestion();
        });
    }
    
    function addNewQuestion() {
        // Get current count of actual questions (excluding the one with id="title")
        const currentQuestionCount = document.querySelectorAll('.inner-container .medium-green-title:not(#title)').length;
        questionCount = currentQuestionCount + 1;
        
        const newQuestion = document.createElement('div');
        newQuestion.className = 'inner-container question-container new-question';
        newQuestion.innerHTML = `
            <div class="between-stretch">
                <div class="medium-green-title">Question ${questionCount}</div>
                <button type="button" class="red-border-button delete-question">
                    <img src="../../image/delete.svg" alt="Delete" />
                </button>
            </div>
            
            <div class="label-field">
                <label class="green-description">Question Type</label>
                <select class="dropdown question-type" name="questionType${questionCount}">
                    <option value="mcq">MCQ Question</option>
                    <option value="open">Open-Ended Question</option>
                </select>
            </div>
            
            <div class="label-field">
                <label class="green-description">Question Text</label>
                <input type="text" placeholder="Enter Text..." name="questionText${questionCount} required" />
            </div>
            
            <div class="label-field mcq-section">
                <label class="green-description">Choices</label>
                <div class="near-button-column">
                    <div class="near-button-row">
                        <input type="radio" name="question${questionCount}" value="choice1" >
                        <input type="text" placeholder="Enter Choice..." name="choice1_${questionCount}" />
                    </div>
                    <div class="near-button-row">
                        <input type="radio" name="question${questionCount}" value="choice2">
                        <input type="text" placeholder="Enter Choice..." name="choice2_${questionCount}" />
                    </div>
                    <div class="near-button-row">
                        <input type="radio" name="question${questionCount}" value="choice3">
                        <input type="text" placeholder="Enter Choice..." name="choice3_${questionCount}" />
                    </div>
                    <div class="near-button-row">
                        <input type="radio" name="question${questionCount}" value="choice4">
                        <input type="text" placeholder="Enter Choice..." name="choice4_${questionCount}" />
                    </div>
                </div>
            </div>
            
            <div class="label-field open-ended-section" style="display: none;">
                <label class="green-description">Correct Answer</label>
                <input type="text" placeholder="Enter Correct Answer..." name="correctAnswer${questionCount}" />
            </div>
        `;
        
        // Insert the new question at the End of all questions (before the final button group)
        const allButtonGroups = document.querySelectorAll('.right-button-group');
        const finalButtonGroup = allButtonGroups[allButtonGroups.length - 1];
        finalButtonGroup.parentNode.insertBefore(newQuestion, finalButtonGroup);
        
        // Initialize event listeners for the new question
        initializeQuestionListeners(newQuestion);
        
        // Smooth scroll to new question
        newQuestion.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    
    function initializeQuestionListeners(container = document) {
        // Question type change listeners
        container.querySelectorAll('.question-type').forEach(select => {
            select.addEventListener('change', function() {
                handleQuestionTypeChange(this);
            });
            
            // Initialize the display state
            handleQuestionTypeChange(select);
        });
        
        // Delete question listeners
        container.querySelectorAll('.delete-question').forEach(button => {
            button.addEventListener('click', function() {
                deleteQuestion(this);
            });
        });
    }
    
    function handleQuestionTypeChange(selectElement) {
        const questionContainer = selectElement.closest('.question-container');
        const mcqSection = questionContainer.querySelector('.mcq-section');
        const openEndedSection = questionContainer.querySelector('.open-ended-section');
        const mcqTexts = mcqSection ? mcqSection.querySelectorAll('input[type="text"]') : [];
        const mcqRadios = mcqSection ? mcqSection.querySelectorAll('input[type="radio"]') : [];
        const openInput = openEndedSection ? openEndedSection.querySelector('input') : null;

        if (selectElement.value === 'mcq') {
            if (mcqSection) mcqSection.style.display = 'flex';
            if (openEndedSection) openEndedSection.style.display = 'none';

            mcqRadios.forEach(radio => radio.required = true);
            mcqTexts.forEach(text => text.required = true);
            if (openInput) openInput.required = false;

        } else if (selectElement.value === 'open') {
            if (mcqSection) mcqSection.style.display = 'none';
            if (openEndedSection) openEndedSection.style.display = 'flex';

            mcqRadios.forEach(radio => radio.required = false);
            mcqTexts.forEach(text => text.required = false);
            if (openInput) openInput.required = true;
        }
    }
    
    function deleteQuestion(deleteButton) {
        const questionContainer = deleteButton.closest('.question-container');        
        
        questionContainer.style.opacity = '0';
        questionContainer.style.transform = 'translateX(-100%)';
        questionContainer.style.transition = 'all 0.3s ease';
        
        setTimeout(() => {
            questionContainer.remove();
            renumberQuestions();
        }, 300);
    }
    
    function renumberQuestions() {
        const questions = document.querySelectorAll('.inner-container .medium-green-title:not(#title)');
        questions.forEach((title, index) => {
            title.textContent = `Question ${index + 1}`;
            // Also update the radio button names and other question-specific attributes
            updateQuestionAttributes(title.closest('.question-container'), index + 1);
        });
        questionCount = questions.length;
    }
    
    function updateQuestionAttributes(questionContainer, newNumber) {
        // Update radio button names
        const radioButtons = questionContainer.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.name = `question${newNumber}`;
        });
        
        // Update select name
        const select = questionContainer.querySelector('.question-type');
        if (select) {
            select.name = `questionType${newNumber}`;
        }
        
        // Update text input names
        const questionText = questionContainer.querySelector('input[type="text"][placeholder="Enter Text..."]');
        if (questionText) {
            questionText.name = `questionText${newNumber}`;
        }
        
        // Update choice names
        const choiceInputs = questionContainer.querySelectorAll('input[type="text"][placeholder="Enter Choice..."]');
        choiceInputs.forEach((input, index) => {
            input.name = `choice${index + 1}_${newNumber}`;
        });
        
        // Update correct answer name
        const correctAnswer = questionContainer.querySelector('input[type="text"][placeholder="Enter Correct Answer..."]');
        if (correctAnswer) {
            correctAnswer.name = `correctAnswer${newNumber}`;
        }
    }

    initializeQuestionListeners();
});