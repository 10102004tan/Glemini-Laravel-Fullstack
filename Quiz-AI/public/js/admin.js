const modalBody = document.getElementById('modal-body');
const btnDetailsQuiz = document.querySelectorAll('.btn-detail');
const btnAppectQuizs = document.querySelectorAll('.btn-accept');
const btnRejectQuizs = document.querySelectorAll('.btn-reject');
const btnDeleteQuizs = document.querySelectorAll('.btn-delete');


// fetch detail quiz
btnDetailsQuiz.forEach((btn) => {
    btn.addEventListener('click', async () => {
        const formData = new FormData();
        formData.append('quizId', btn.getAttribute('quizId'));

        try {
            const url = window.routes.quizzDetails;
            const response = await axios.post(url, formData);
            const data = response.data;
            let questionsData = `<ol class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5 mb-4 md:mb-5">`;
            if (data) {

                data.questions.forEach((question, index) => {
                    questionsData += `
                    <li class="mb-10 ms-8">
                        <i class="fa-solid fa-question absolute flex items-center justify-center w-6 h-6 bg-gray-500 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600"></i>
                        <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">${question['excerpt']}</h3>
    
                    `
                    let answersContent = `<ul>`;
                    question['answers'].forEach((answer, index) => {
                        answersContent += `
                        <li class="flex items-center gap-2">
                            <i class="fa-duotone ${(answer['is_correct'] == 0) ? 'fa-circle-xmark text-red-600' : 'fa-circle-check text-green-500'} "></i>
                            <span$ class="text-black">${answer['content']}</span>
                        </li>
                    `

                    });
                    answersContent += `</ul>`
                    questionsData += answersContent;
                    questionsData += `</li>`
                });
                questionsData += `</ol>`;
                const modalContent = questionsData
                modalBody.innerHTML = modalContent;
            }

        } catch (err) {
            console.log(err);
        }
    });
});

//fetch accept quiz
btnAppectQuizs.forEach((btn) => {
    btn.addEventListener('click', () => {
        if (btn.getAttribute('status') == 2) {
            Toastify({
                text: `Quiz này đã được duyệt`,
                duration: 1500,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "#ff4444",
                },
            }).showToast();
        }
        else {
            Swal.fire({
                title: 'Xác nhận duyệt',
                text: 'Bạn có muốn duyệt quiz này không ?',
                icon: 'info',
                confirmButtonText: 'Yes',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('quizId', btn.getAttribute('quizId'));
                    try {
                        const url = window.routes.quizAccept;
                        const response = await axios.post(url, formData);
                        const data = response.data;
                        if (data.status = 200) {
                            btn.parentElement.parentElement.previousElementSibling.innerHTML = `<i class="fa-duotone fa-badge-check text-green-400"></i><span>published</span>`;
                            btn.nextElementSibling.classList.remove('btn-reject');
                            btn.nextElementSibling.classList.add('btn-delete');
                            btn.nextElementSibling.textContent = 'Delete';
                            Toastify({
                                text: `${data.message}`,
                                duration: 1500,
                                destination: `${data.message}`,
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

                    } catch (err) {
                        console.log(err);
                    }
                }
            });
        }

    });

});

//fetch delete quiz
btnDeleteQuizs.forEach((btn) => {
    btn.addEventListener('click', () => {
        Swal.fire({
            title: 'Xác nhận xóa',
            text: 'Bạn có muốn xóa quiz này không ?',
            icon: 'danger',
            confirmButtonText: 'Yes',
        }).then(async (result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('quizId', btn.getAttribute('quizId'));
                try {
                    const url = window.routes.quizDestroy;
                    const response = await axios.post(url, formData);
                    const data = response.data;
                    if (data.status = 200) {
                        btn.parentElement.parentElement.parentElement.remove();
                        Toastify({
                            text: `${data.message}`,
                            duration: 1500,
                            destination: `${data.message}`,
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

                } catch (err) {
                    console.log(err);
                }
            }
        });
    });

});

//fetch reject quiz
btnRejectQuizs.forEach((btn) => {
    btn.addEventListener('click', () => {
        Swal.fire({
            title: 'Xác nhận từ chối',
            text: 'Bạn có muốn từ chối quiz này không ?',
            icon: 'warning',
            confirmButtonText: 'Yes',
        }).then(async (result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('quizId', btn.getAttribute('quizId'));
                try {
                    const url = window.routes.quizReject;
                    const response = await axios.post(url, formData);
                    const data = response.data;
                    if (data.status = 200) {
                        btn.parentElement.parentElement.previousElementSibling.innerHTML = `<i class="fa-solid fa-message-xmark text-red-600"></i><span>rejected</span>`;
                        btn.remove();
                        Toastify({
                            text: `${data.message}`,
                            duration: 1500,
                            destination: `${data.message}`,
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

                } catch (err) {
                    console.log(err);
                }
            }
        });
    });

});