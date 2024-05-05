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




const employeeColumn = $(".employee-column");

employeeColumn.click(function() {
    const empId = $(this).find('.emp-id').html();
    const empName = $(this).find('.emp-name').html();
    const empDept = $(this).find('.emp-dept').html();
    const empPfp = $(this).find('.emp-pfp').attr('src');
    miniProfileModal.find('.mini-profile-name').html(empName);
    miniProfileModal.find('.mini-profile-dept').html(empDept);
    miniProfileModal.find('.emp-mini-profile-pfp').attr('src', empPfp);
    showModal(miniProfileModal);
    closeModal(miniProfileModal, false);

    viewFullProfileBtn.click(function() {
        window.location.href = "/TreasuryViewEmployee/" + empId;
    })
})

sortEmp.change(function() {
    const value = $(this).val();
    sortEmpCont.html();

    if(employeesList == null) {
        return;
    }

    if(value == 'a-z') {
        
    }
});

searchEmp.on('input',function() {
    const searchValue = $(this).val();

    console.log(searchValue);

    employeeColumn.each(function() {
        employeeColumn.find()
    });
});

function sortAscending() {
    employeesList.sort(function(a, b) {
        // Extract firstname and lastname from each employee object
        const firstNameA = a.firstname.toUpperCase(); // Ignore case sensitivity
        const firstNameB = b.firstname.toUpperCase();
        const lastNameA = a.lastname.toUpperCase();
        const lastNameB = b.lastname.toUpperCase();
    
        // Compare firstnames first
        if (firstNameA < firstNameB) {
            return -1;
        } else if (firstNameA > firstNameB) {
            return 1;
        } else {
            // If firstnames are the same, compare lastnames
            if (lastNameA < lastNameB) {
                return -1;
            } else if (lastNameA > lastNameB) {
                return 1;
            } else {
                return 0; // Names are identical
            }
        }
    });
}