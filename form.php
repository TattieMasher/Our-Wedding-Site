<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding RSVP</title>
    <link rel="stylesheet" href="form-styles.css">
</head>
<body>
    <div class="rsvp-container">
        <h2>You're Invited! RSVP Here 🎉</h2>
        <form class="rsvp-form" id="rsvpForm">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="First and Last Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Mobile Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="e.g., +44 1234 567890" required>

            <label for="dietary">Dietary Requirements:</label>
            <input type="text" id="dietary" name="dietary" placeholder="Any dietary needs?">

            <div id="partyMembers">
                <!-- New party members will be appended here -->
            </div>

            <button type="button" class="add-member-button" onclick="addPartyMember()">Add Another Guest</button>

            <label for="song">Song Request:</label>
            <input type="text" id="song" name="song" placeholder="Got a favorite tune?">

            <button type="submit">Send RSVP</button>
        </form>
    </div>

    <script>
        let memberCount = 0;

        function addPartyMember() {
            memberCount++;

            const memberDiv = document.createElement('div');
            memberDiv.classList.add('party-member');
            memberDiv.innerHTML = `
                <h3>Guest ${memberCount}:</h3>
                <label for="memberName${memberCount}">Name:</label>
                <input type="text" id="memberName${memberCount}" name="memberName${memberCount}" placeholder="First and Last Name" required>

                <label for="memberDietary${memberCount}">Dietary Requirements:</label>
                <input type="text" id="memberDietary${memberCount}" name="memberDietary${memberCount}" placeholder="Any dietary needs?">
            `;
            document.getElementById('partyMembers').appendChild(memberDiv);
        }
    </script>
</body>
</html>
