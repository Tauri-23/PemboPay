//modals
const miniProfileModal = $("#emp-mini-profile-1-modal");

//btns
const viewFullProfileBtn = $('#view-full-profile-btn');

//dropdowns
const sortEmp = $('#sort-emp');

//searchBar
const searchEmp = $('#search-emp');

// Result employees cont
const origEmpCont = $('#original-emp-cont');
const sortEmpCont = $('#sort-result-emp-cont');




let employeeColumn = $(".employee-column");

employeeColumn.click(function() {
    empColumnEvent($(this));
})

sortEmpCont.on('click', '.table1-data.employee-column', function() {
    empColumnEvent($(this));
});

sortEmp.change(function() {
    const value = $(this).val();
    sortEmpCont.html('');

    if(employeesList == null) {
        return;
    }

    if(value == 'a-z') {
        origEmpCont.addClass('d-none');
        sortEmpCont.removeClass('d-none');
        sortAscending();
        
        renderEmployeesTable();
    }

    else if(value == 'z-a') {
        origEmpCont.addClass('d-none');
        sortEmpCont.removeClass('d-none');
        sortDescending();
        
        renderEmployeesTable();
    }

    else {
        origEmpCont.removeClass('d-none');
        sortEmpCont.addClass('d-none');
    }
});

searchEmp.on('input',function() {
    const searchValue = $(this).val();

    console.log(searchValue);

    employeeColumn.each(function() {
        employeeColumn.find()
    });
});





function renderEmployeesTable() {
    sortEmpCont.append(`
        <div class="table1">
            <div class="table1-header">
                <div class="form-data-col">
                    <small class="text-m2">Employee Name</small>
                    <div class="table1-PFP-small-cont mar-end-1"></div>
                </div>
                <small class="text-m2 form-data-col">Employee ID</small>
                <small class="text-m2 form-data-col">Employee Email</small>
                <small class="text-m2 form-data-col">Department</small>
                <small class="text-m2 form-data-col">Compensation Type</small>
            </div>
        </div>
        `);

    employeesList.forEach(employee => {
        const employeeRowHtml = `
            <div class="table1-data employee-column" id="${employee.id}">
                <div class="form-data-col">
                    <div class="table1-PFP-small mar-end-1">
                        <img class="emp-pfp" src="/assets/media/pfp/${employee.pfp}" alt="">
                    </div>
                    <small class="text-m2 emp-name">${employee.firstname} ${employee.lastname}</small>
                </div>
                <small class="text-m3 form-data-col emp-id">${employee.id}</small>
                <small class="text-m3 form-data-col">${employee.email}</small>
                <small class="text-m3 form-data-col emp-dept">${employee.department.department_name}</small>
                <small class="text-m3 form-data-col">${employee.compensation.compentsation_type}</small>
            </div>
        `;

        sortEmpCont.find('.table1').append(employeeRowHtml);
    });
}


function empColumnEvent(empColumn) {
    const empId = empColumn.find('.emp-id').html();
    const empName = empColumn.find('.emp-name').html();
    const empDept = empColumn.find('.emp-dept').html();
    const empPfp = empColumn.find('.emp-pfp').attr('src');

    // Update mini-profile modal with employee data
    miniProfileModal.find('.mini-profile-name').html(empName);
    miniProfileModal.find('.mini-profile-dept').html(empDept);
    miniProfileModal.find('.emp-mini-profile-pfp').attr('src', empPfp);

    // Show the modal
    showModal(miniProfileModal);
    closeModal(miniProfileModal, false);

    // Handle viewFullProfileBtn click within the modal
    viewFullProfileBtn.off('click').on('click', function() {
        window.location.href = "/TreasuryViewEmployee/" + empId;
    });
}

function sortAscending() {
    employeesList.sort(function(a, b) {
        const firstNameA = a.firstname.toUpperCase();
        const firstNameB = b.firstname.toUpperCase();
        const lastNameA = a.lastname.toUpperCase();
        const lastNameB = b.lastname.toUpperCase();
    
        if (firstNameA < firstNameB) {
            return -1;
        } else if (firstNameA > firstNameB) {
            return 1;
        } else {
            if (lastNameA < lastNameB) {
                return -1;
            } else if (lastNameA > lastNameB) {
                return 1;
            } else {
                return 0;
            }
        }
    });
}

function sortDescending() {
    employeesList.sort(function(a, b) {
        const firstNameA = a.firstname.toUpperCase();
        const firstNameB = b.firstname.toUpperCase();
        const lastNameA = a.lastname.toUpperCase();
        const lastNameB = b.lastname.toUpperCase();

        if (firstNameA > firstNameB) {
            return -1;
        } else if (firstNameA < firstNameB) {
            return 1;
        } else {
            if (lastNameA > lastNameB) {
                return -1;
            } else if (lastNameA < lastNameB) {
                return 1;
            } else {
                return 0;
            }
        }
    });
}
