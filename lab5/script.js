function analyzeText()
{
    var text = document.getElementById("textInput").value;

    // Empty input check
    if(text.trim() === "")
    {
        alert("Please enter some text");
        return;
    }

    // Character count
    var charCount = text.length;

    // Word count (handle multiple spaces)
    var words = text.trim().split(/\s+/);
    var wordCount = words.length;

    // Reverse text
    var reversed = text.split("").reverse().join("");

    // Display result
    document.getElementById("result").innerHTML =
        "<b>Character Count:</b> " + charCount + "<br>" +
        "<b>Word Count:</b> " + wordCount + "<br><br>" +
        "<b>Reversed Text:</b><br>" + reversed;
}