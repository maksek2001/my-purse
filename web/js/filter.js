let filterCosts = document.getElementById('filter-cost');
let filterCrediting = document.getElementById('filter-crediting');

function renderAll(type) {
    let elements = document.querySelector(`#elements-${type}`);
    for (let i = 0; i < elements.children.length; i++) {
        elements.children[i].classList.remove('hide');
    }
}

function renderByDate(startDate, endDate, type) {
    let elements = document.querySelector(`#elements-${type}`);
    console.log(elements);
    for (let i = 0; i < elements.children.length; i++) {
        let tmpElem = elements.children[i];
        let dataDate = new Date(tmpElem.getAttribute('data-date'));

        if (dataDate < startDate || dataDate > endDate) {
            tmpElem.classList.add('hide')
        }
    }
}

function render(type) {
    let startDate = document.getElementById(`${type}-start-date`).value;
    let endDate = document.getElementById(`${type}-end-date`).value;

    renderAll(type);

    if (startDate != '' && endDate != '') {
        renderByDate(new Date(startDate), new Date(endDate), type);
    }

}

filterCosts.onclick = function () { render('cost') };
filterCrediting.onclick = function () { render('crediting') };