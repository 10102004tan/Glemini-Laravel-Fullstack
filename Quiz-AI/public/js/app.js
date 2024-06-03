

// click edit btn question
const btnSettings = document.getElementById('btn-settings');
const btnCloseSettings = document.querySelector('.btn-close-settings');
const settings = document.querySelector('.settings');
const btnEditQuestions = document.querySelectorAll('.btn-edit-question');
const modalEditQuestion = document.querySelectorAll('.modal-edit-question');
const modalDestroyQuestion = document.querySelectorAll('.modal-destroy-question');
const modalQuestion = document.querySelectorAll('.modal-question');
const btnCancels = document.querySelectorAll('.btn-cancel');
const btnEditQuiz = document.querySelector('.btn-edit-quiz');
const modelEditQuiz = document.querySelector('.modal-edit-quiz');
const btnCloseEditQuiz = document.querySelector('.btn-close-modal-edit-quiz');
const showOptions = document.querySelectorAll('.show-option');
const modalShowOptionText = document.querySelector('.modal-show-option-text');
const modalShowOptionManual = document.querySelector('.modal-show-option-manual');
const overlayLoading = document.querySelector('.overlay-loading');
const btnGenerateAI = document.querySelector('.btn-generate-ai');
const resultIntro = document.querySelector('.result-intro');
const resultQuestions = document.querySelector('.result-questions');
const selectOptionQuestion = document.querySelector('.select-option-manual-question');
const selectOptionManualCorrect = document.querySelector('.select-option-manual-correct');
const btnResetForm = document.querySelector('.btn-reset-form');
const modalUpdateQuiz = document.querySelector('.modal-update-quiz');
const modalBody = document.querySelector('.modal-body');
const btnPublished = document.querySelector('.btn-published');
const published = document.querySelector('.published-body');
const formPublsihed = document.getElementById('form-published');

let preShowOption = showOptions[0];


if (formPublsihed != null) {
    formPublsihed.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('quizId', formPublsihed.getAttribute('quizId'));
        try {
            // // // Send AJAX POST request using Axios
            const url = window.routes.quizzesPublished;
            const response = await axios.post(url, formData);
            const result = response.data;
            checkStatus(result, 
            function () {
                //show success
                //dissmiss modal
            },
            function(){
                //show error
            });
        }
        catch (error) {
            console.error('Error:', error);
        }
    });

}

//check select option question
window.onload = function() {
    if (window.location.search.indexOf('text') > -1 || window.location.search == "") {
        modalShowOptionText.classList.remove('hidden');
        modalShowOptionManual.classList.add('hidden');
        preShowOption.classList.remove('active');
        showOptions[0].classList.add('active');
        preShowOption = showOptions[0];
    }
    else if (window.location.search.indexOf('manual') > -1){
        modalShowOptionManual.classList.remove('hidden');
        modalShowOptionText.classList.add('hidden');
        preShowOption.classList.remove('active');
        showOptions[1].classList.add('active');
        preShowOption = showOptions[1];
    }
  }

// 
selectOptionQuestion.addEventListener('change', function () {
    if (selectOptionQuestion.value == "checkbox") {
        selectOptionManualCorrect.multiple = true;
    } else {
        selectOptionManualCorrect.multiple = false;
    }
});

//reset form
btnResetForm.addEventListener('click', function (e) {
    e.preventDefault();
    modalShowOptionManual.reset();
});


for (let i = 0; i < btnEditQuestions.length; i++) {
    btnEditQuestions[i].addEventListener('click', function () {
        modalEditQuestion[i].classList.remove('hidden');
        modalQuestion[i].classList.add('hidden');
        modalEditQuestion[i].classList.add('flex');


    });

    btnCancels[i].addEventListener('click', function () {
        modalEditQuestion[i].classList.add('hidden');
        modalEditQuestion[i].classList.remove('flex');
        modalQuestion[i].classList.remove('hidden');
    });
}


// click edit btn quiz
if (btnEditQuiz != null) {
    btnEditQuiz.addEventListener('click', function () {
        modelEditQuiz.classList.toggle('invisible');
        modelEditQuiz.classList.toggle('opacity-0');
    });
}

if (btnCloseEditQuiz != null) {
    btnCloseEditQuiz.addEventListener('click', function () {
        modelEditQuiz.classList.toggle('invisible');
        modelEditQuiz.classList.toggle('opacity-0');
    });
};

if (btnSettings != null) {
    btnSettings.addEventListener('click', function () {
        settings.classList.toggle('right-[-100%]');
        settings.classList.toggle('right-0');
    });
    btnCloseSettings.addEventListener('click', function () {
        settings.classList.toggle('right-[-100%]');
        settings.classList.toggle('right-0');
    });
    
}



// show options

if (showOptions.length > 0) {
    preShowOption = showOptions[0];
}

showOptions.forEach((showOption) => {
    showOption.addEventListener('click', function () {
        if (showOption.getAttribute('option-data') == "0") {
            modalShowOptionText.classList.remove('hidden');
            modalShowOptionManual.classList.add('hidden');
            history.pushState(null, null, '?text');
        } else {
            modalShowOptionManual.classList.remove('hidden');
            modalShowOptionText.classList.add('hidden');
            history.pushState(null, null, '?manual');
        }

        preShowOption.classList.remove('active');
        showOption.classList.add('active');
        preShowOption = showOption;
    });
});


btnGenerateAI.addEventListener('click', function () {
    overlayLoading.classList.remove('hidden');
    overlayLoading.classList.add('flex');
});

if (modalUpdateQuiz != null) {
// update quiz
modalUpdateQuiz.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btnSubmit = modalUpdateQuiz.querySelector('.btn-update-quiz');
    btnSubmit.textContent = 'Updating...';
    const formData = new FormData(modalUpdateQuiz);
    try {
        // // Send AJAX POST request using Axios
        const url = window.routes.quizzesUpdate;
        const response = await axios.post(url, formData);
        const result = response.data;
        checkStatus(result, function () {
            btnSubmit.textContent = 'Update';
            modalUpdateQuiz.parentElement.previousElementSibling.firstElementChild.firstElementChild.textContent = result.quiz.title;
        },
            function () {
                //show error
            });
    } catch (error) {
        console.error('Error:', error);
    }
});
}

//edit question
modalEditQuestion.forEach((modalEdit) => {
    modalEdit.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(modalEdit);
        formData.append('_method', 'PUT');
        formData.append('id', modalEdit.getAttribute('questionId'));
        const corrects = formData.getAll('correct');
        let dataAnswers = [];
        formData.getAll('answer').forEach((answer, index) => {
            dataAnswers.push({
                id: formData.getAll('answer_id')[index],
                content: answer,
                is_correct: (corrects.includes(index.toString()) ? 1 : 0)
            });
        });
        formData.append('answers', JSON.stringify(dataAnswers));
        formData.delete('answer_id');
        formData.delete('answer');
        formData.delete('correct');
        try {
            const url = window.routes.quizzesQuestionUpdate;
            const response = await axios.post(url, formData);
            const result = await response.data;
            checkStatus(result, function () {
                //update question
                const modalQuestion = modalEdit.previousElementSibling;
                let answers = "";
                result.question.answers.forEach((answer) => {
                    answers += `
                    <div class="mb-3">
                        <input type="${result.question.type}" name="answer_${answer['id']}" value="${answer['id']}" ${(answer['is_correct'] == 1) ? "checked" : ""} id="answer_${answer['id']}">
                        <label for="answer_${answer['id']}">${answer['content']}</label>
                    </div>
                    `
                });

                const excerpt = `
                <div class="excerpt" class="mb-4">
                    <p class="text-[20px] text-[#eee]">${result.question.excerpt}</p>
                </div>
                `;
                console.log(excerpt)
                modalQuestion.firstElementChild.innerHTML = excerpt;
                modalQuestion.children[1].innerHTML = answers;
            },
                function () {
                    //show error
                });
        }
        catch (error) {
            console.error('Error:', error);
        }
    });
});

// delete question
modalDestroyQuestion.forEach((modalDestroy) => {
    modalDestroy.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(modalDestroy);
        formData.append('_method', 'DELETE');
        formData.append('id', modalDestroy.getAttribute('questionId'));
        try {
            // // Send AJAX POST request using Axios
            const url = window.routes.quizzesQuestionDestroy;
            const response = await axios.post(url, formData);
            const result = response.data;
            checkStatus(result, function () {
                modalDestroy.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
            },
                function () {
                    //show error
                });
        } catch (error) {
            console.error('Error:', error);
        }
    });
});


// creatq question modal-show-option-manual
modalShowOptionManual.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(modalShowOptionManual);
    const answers = formData.getAll('answer');
    const corrects = formData.getAll('is_correct');
    let dataAnswers = [];
    answers.forEach((answer, index) => {
        dataAnswers.push({
            content: answer,
            is_correct: (corrects.includes(index.toString()) ? 1 : 0)
        });
    });
    formData.append('answers', JSON.stringify(dataAnswers));
    formData.append('quiz_id', modalShowOptionManual.getAttribute('quizId'));
    formData.delete('answer');
    formData.delete('is_correct');
    try {
        // // Send AJAX POST request using Axios
        const url = window.routes.quizzesQuestionStore;
        const response = await axios.post(url, formData);
        const result = await response.data;
        checkStatus(result,
            function () {
                //add question to list
                window.location.reload();
                console.log("test")

            },
            function () {
                // reload page
                window.location.href = window.location.href + '/' + result.quizId + '?manual';
                console.log("test 2")

            });

    } catch (error) {
        console.error('Error:', error);
    }
});

function checkStatus(result, callbackSuccess, callbackOrder) {
    if (result.status == 200) {
        Toastify({
            text: `${result.message}`,
            duration: 1000,
            destination: `${result.message}`,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#26d63a",
            },
        }).showToast();
        callbackSuccess();
    }
    else {
        
        Toastify({
            text: `${result.message}`,
            duration: 2000,
            destination: `${result.message}`,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: `${(result.status == 999) ? "#26d63a" : "#cd4316"}`,
            },
            callback: function (instance, toast) {
                callbackOrder();
            }
        }).showToast();
    }
}