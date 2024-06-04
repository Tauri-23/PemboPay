//searchBar
const searchDept = $('#search-dept');

//dropdowns
const sortDept = $('#sort-dept');

// Result departments cont
const origDeptCont = $('#original-dept-cont');
const sortDeptCont = $('#sort-result-dept-cont');





/*
|----------------------------------------
| Sort Search
|----------------------------------------
*/
sortDept.change(function() {
    const value = $(this).val();

    sortDeptCont.html('');

    if(deptList == null) {
        return;
    }

    if(value == 'a-z') {
        origDeptCont.addClass('d-none');
        sortDeptCont.removeClass('d-none');
        sortAscending();
        
        renderDeptTable();
    }

    else if(value == 'z-a') {
        origDeptCont.addClass('d-none');
        sortDeptCont.removeClass('d-none');
        sortDescending();
        
        renderDeptTable();
    }

    else {
        origDeptCont.removeClass('d-none');
        sortDeptCont.addClass('d-none');
    }
});

searchDept.on('input', function() {
    const searchValue = $(this).val();

    if(!isEmptyOrSpaces(searchValue)) {
        origDeptCont.addClass('d-none');
        sortDeptCont.removeClass('d-none');
        processSearch(searchValue);
    }
    else {
        origDeptCont.removeClass('d-none');
        sortDeptCont.addClass('d-none'); 
    }
});





/*
|----------------------------------------
| Search functions
|----------------------------------------
*/
function processSearch(value) {
    const filteredDeptList = deptList.filter(dept => {
        const lowerCaseValue = value.toLowerCase();

        return dept.department_name.toLowerCase().includes(lowerCaseValue)  
            || dept.department_tag.toLowerCase().includes(lowerCaseValue);
    });
    

    sortDeptCont.html('');

    if(filteredDeptList.length > 0) {
        filteredDeptList.forEach(dept => {
            sortDeptCont.append(`
            <a href="/adminViewDept/${dept.id}" id="Department_ID" class="departments-cont-box departments">
                <div class="department-name" style="z-index: 2;">${dept.department_name} (${dept.department_tag})</div>
                <div class="overlay-blur-dark"></div>
                <img class="department-pic" src="/assets/media/dept-pfp/${dept.department_pfp}" />
            </a>
        `);
        });
    }
    else {
        sortDeptCont.append(`
        <div class="placeholder-illustrations">
            <div class="d-flex flex-direction-y gap2">
                <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
                <div class="text-l3 text-center">No Result</div>
            </div>
        </div>
        `);
    }

    
}





/*
|----------------------------------------
| Sort Functions
|----------------------------------------
*/
function sortAscending() {
    deptList.sort(function(a, b) {
        const deptNameA = a.department_name.toUpperCase();
        const deptNameB = b.department_name.toUpperCase();
    
        if (deptNameA < deptNameB) {
            return -1;
        } else if (deptNameA > deptNameB) {
            return 1;
        }
    });
}

function sortDescending() {
    deptList.sort(function(a, b) {
        const deptNameA = a.department_name.toUpperCase();
        const deptNameB = b.department_name.toUpperCase();

        if (deptNameA > deptNameB) {
            return -1;
        } else if (deptNameA < deptNameB) {
            return 1;
        }
    });
}





/*
|----------------------------------------
| Render Department Row
|----------------------------------------
*/
function renderDeptTable() {
    console.log(deptList);
    deptList.forEach(dept => {
        sortDeptCont.append(`
            <a href="/adminViewDept/${dept.id}" id="Department_ID" class="departments-cont-box departments">
                <div class="department-name" style="z-index: 2;">${dept.department_name} (${dept.department_tag})</div>
                <div class="overlay-blur-dark"></div>
                <img class="department-pic" src="/assets/media/dept-pfp/${dept.department_pfp}" />
            </a>
        `);
    });
}