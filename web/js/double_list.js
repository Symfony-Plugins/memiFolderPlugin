function double_list_move(src, dest)
{
  for (var i = 0; i < src.options.length; i++)
  {
    if (src.options[i].selected)
    {
      dest.options[dest.length] = new Option(src.options[i].text, src.options[i].value);
      src.options[i] = null;
      --i;
    }
  }
}

function double_list_submit()
{
  // get all selects with double list class
    selects = $$('select.double_list');

    selects.each(function(element){
        for (var i = 0; i < element.options.length; i++)
            element.options[i].selected = true;
    });

    return true;
}