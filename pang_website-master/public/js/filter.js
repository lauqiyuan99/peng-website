const ddlDropdownControl = document.querySelector('[data-ddl]');
const compareFieldControl = document.querySelectorAll('[data-compare]');
const defaultOption = ddlDropdownControl.options[0].text;// Always get first value of dropdownlist and set to default value


ddlDropdownControl.addEventListener("change", () => {
    const ddlSelectedValue = ddlDropdownControl.options[ddlDropdownControl.selectedIndex].text;
    compareFieldControl.forEach((item) => {
        if (defaultOption === ddlSelectedValue) {
            item.style.display = "block";
            return;
        }
        const compareFieldValue = item.dataset.compare.toLowerCase();
        const isVisible = compareFieldValue.includes(ddlSelectedValue.toLowerCase());
        item.style.display = isVisible? "block" : "none";
    });
});


