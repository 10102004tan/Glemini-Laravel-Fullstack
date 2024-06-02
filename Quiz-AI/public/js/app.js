

// click edit btn question
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
let preShowOption = null;



// 
selectOptionQuestion.addEventListener('change', function () {
    console.log(selectOptionQuestion.value)
    console.log(selectOptionManualCorrect);
    if (selectOptionQuestion.value == 1) {
        selectOptionManualCorrect.multiple = true;
    } else {
        selectOptionManualCorrect.multiple = false;
    }
});

//reset form
btnResetForm.addEventListener('click', function (e) {
    e.preventDefault();
    modalShowOptionText.reset();
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
btnEditQuiz.addEventListener('click', function () {
    modelEditQuiz.classList.toggle('invisible');
    modelEditQuiz.classList.toggle('opacity-0');
});

btnCloseEditQuiz.addEventListener('click', function () {
    modelEditQuiz.classList.toggle('invisible');
    modelEditQuiz.classList.toggle('opacity-0');
});


// show options

if (showOptions.length > 0) {
    preShowOption = showOptions[0];
}

showOptions.forEach((showOption) => {
    showOption.addEventListener('click', function () {
        if (showOption.getAttribute('option-data') == "0") {
            modalShowOptionText.classList.remove('hidden');
            modalShowOptionManual.classList.add('hidden');
        } else {
            modalShowOptionManual.classList.remove('hidden');
            modalShowOptionText.classList.add('hidden');
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

// create quiz ai
//ajax

//  modalShowOptionText.addEventListener('submit', async (e) => {
//     e.preventDefault();
//     overlayLoading.classList.remove('hidden');
//     const formData = new FormData(modalShowOptionText);
//     console.log(Object.fromEntries(formData));
//     try {
//             // // Send AJAX POST request using Axios
//             const url = window.routes.quizzesQuestionsStore;
//             const response = await axios.post(url, formData);
//             const result = response.data;
//             console.log(result);
//             resultIntro.remove();
//             resultQuestions.classList.remove('hidden');
//             modalShowOptionText.reset();
//             overlayLoading.classList.add('hidden');
//         } catch (error) {
//             console.error('Error:', error);
//         }
// });


// update quiz
modalUpdateQuiz.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btnSubmit = modalUpdateQuiz.querySelector('.btn-update-quiz');
    btnSubmit.textContent = 'Updating...';
    const formData = new FormData(modalUpdateQuiz);
    console.log(Object.fromEntries(formData));
    try {
        // // Send AJAX POST request using Axios
        const url = window.routes.quizzesUpdate;
        const response = await axios.post(url, formData);
        const result = response.data;
        if (result.status == 400) {
            btnSubmit.textContent = 'Update';
            modalUpdateQuiz.parentElement.previousElementSibling.previousElementSibling.textContent = result.quiz.title;
            Toastify({
                text: "Thành công",
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
                onClick: function () { } // Callback after click
            }).showToast();
        }
        else {
            Toastify({
                text: "Error",
                duration: 1000,
                destination: `${result.message}`,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "#cd4316",
                },
                onClick: function () { } // Callback after click
            }).showToast();
        }
    } catch (error) {
        console.error('Error:', error);
    }
});




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
            const result = response.data;
            console.log(result);
            if (result.status == 200) {
                const modalQuestion = modalEdit.previousElementSibling;
                let answers = "";
                result.question.answers.forEach((answer) => {
                    answers += `
                    <div class="mb-3">
                        <input type="${result.question.type}" name="answer_${answer['id']}" value="${answer['id']}" ${(answer['is_correct'] == 1) ? "checked" : "" } id="answer_${answer['id']}">
                        <label for="answer_${answer['id']}">${answer['content']}</label>
                    </div>
                    `
                });
                const excerpt = `
                <div class="excerpt" class="mb-4">
                    <p class="text-[20px] text-[#eee]">${result.question.excerpt}</p>
                </div>
                `;

                modalQuestion.firstChild.innerHTML = excerpt;
                modalQuestion.children[1].innerHTML = answers;
                Toastify({
                    text: "Sửa Thành công",
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
            }
            else {
                Toastify({
                    text: "Error",
                    duration: 1000,
                    destination: `${result.message}`,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#cd4316",
                    },
                }).showToast();
            }
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
            console.log(result);
            if (result.status == 200) {
                modalDestroy.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
                Toastify({
                    text: "Xóa Thành công",
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
                    onClick: function () { } // Callback after click
                }).showToast();
            }
            else {
                Toastify({
                    text: "Error",
                    duration: 1000,
                    destination: `${result.message}`,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#cd4316",
                    },
                    onClick: function () { } // Callback after click
                }).showToast();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});