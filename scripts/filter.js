//{4 : ["easy", "normal", "hard"]}

function getUniqueValuesFromColumn() {
  var unique_col_values_dict = {};

  allFilters = document.querySelectorAll(".table-filter");
  allFilters.forEach((filter_i) => {
    col_index = filter_i.parentElement.getAttribute("col-index");
    //alert("col number is " + col_index);
    const rows = document.querySelectorAll("#question-table > tbody > tr");

    rows.forEach((row) => {
      console.log(col_index + " INSIDE ROW: " + row.innerHTML);
      if (col_index > 0) {
        cell_value = row.querySelector(
          "td:nth-child(" + col_index + ")"
        ).innerHTML;

        //alert("cell value " + cell_value);
        //if the col index is already present in the dictionary
        if (col_index in unique_col_values_dict) {
          //if the cell value is already present in the array
          if (unique_col_values_dict[col_index].includes(cell_value)) {
            // alert(cell_value + " is already present in the array" + unique_col_values_dict[col_index])
          } else {
            unique_col_values_dict[col_index].push(cell_value);
            //alert("Array after adding the cell value : " + unique_col_values_dict[col_index])
          }
        } else {
          unique_col_values_dict[col_index] = new Array(cell_value);
        }
      }
    });
  });
  for (i in unique_col_values_dict) {
    //alert("column index" + i + " has unique values : \n" + unique_col_values_dict[i]);
  }
  //alert("displaying : "+ unique_col_values_dict.display)
  updateSelectOptions(unique_col_values_dict);
}

function updateSelectOptions(unique_col_values_dict) {
  allFilters = document.querySelectorAll(".table-filter");

  allFilters.forEach((filter_i) => {
    col_index = filter_i.parentElement.getAttribute("col-index");
    if (col_index != 0) {
      unique_col_values_dict[col_index].forEach((i) => {
        filter_i.innerHTML =
          filter_i.innerHTML + `\n<option value="${i}">${i}</option>`;
      });
    }
  });
}

function filter_rows() {
  allFilters = document.querySelectorAll(".table-filter");
  var filter_value_dict = {};

  allFilters.forEach((filter_i) => {
    col_index = filter_i.parentElement.getAttribute("col-index");

    value = filter_i.value;
    if (value != "all") {
      filter_value_dict[col_index] = value;
    }
  });

  var col_cell_value_dict = {};

  const rows = document.querySelectorAll("#question-table tbody tr");
  rows.forEach((row) => {
    var display_row = true;

    allFilters.forEach((filter_i) => {
      col_index = filter_i.parentElement.getAttribute("col-index");
      col_cell_value_dict[col_index] = row.querySelector(
        "td:nth-child(" + col_index + ")"
      ).innerHTML;
    });

    for (var col_i in filter_value_dict) {
      filter_value = filter_value_dict[col_i];
      row_cell_value = col_cell_value_dict[col_i];

      if (row_cell_value.indexOf(filter_value) == -1 && filter_value != "all") {
        display_row = false;
        break;
      }
    }
    if (display_row == true) {
      row.style.display = "table-row";
    } else {
      row.style.display = "none";
    }
  });
}
