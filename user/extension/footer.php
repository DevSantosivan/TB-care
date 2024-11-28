<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('[data-toggle="collapse"]').click(function() {
        var $this = $(this);
        var $icon = $this.find('i');
        var $target = $($this.data('target'));

        $target.collapse('toggle');

        $target.on('show.bs.collapse', function() {
            $icon.removeClass('ti-plus').addClass('ti-minus');
        });

        $target.on('hide.bs.collapse', function() {
            $icon.removeClass('ti-minus').addClass('ti-plus');
        });
    });
});
</script>

<?php 
               $kwery = mysqli_query($con, "SELECT is_active FROM users WHERE user_id='$userid'");
$rows_kwery = mysqli_fetch_array($kwery);
$statusmode = $rows_kwery['is_active'];
                if($statusmode >= 1){ ?>

<?php 
                }elseif($statusmode == 0){ ?>
<meta http-equiv="refresh" content="0; url=pending">
<?php } ?>
<style>
.side-menu-fixed {
    background-color: white !important;
    /* Set background color to white */
}

.side-menu-bg {
    background-color: white !important;
    /* Ensure the background is applied to inner elements */
}

#sidebarnav {
    background-color: white !important;
    /* Apply to the navigation list as well */
}

.scrollbar {
    background-color: white !important;
    /* Apply to the scrollbar area */
}

.side-menu-fixed .scrollbar.side-menu-bg {
    color: black;
    /* Change text to black */
}

#sidebarnav li a {
    display: flex;
    align-items: center;
    /* Vertically center the icon and text */
    gap: 10px;
    /* Adds space between the icon and the text */
    color: black !important;
    /* Text color */
    white-space: nowrap;
    /* Prevent text from wrapping to the next line */
    padding: 10px 15px;
    /* Adds padding for better spacing */
}

#sidebarnav li span,
#sidebarnav li p {
    color: black !important;
    /* Apply black to other text elements */
}

#sidebarnav li a:hover {
    color: darkblue !important;
    /* Example hover color */
}

#sidebarnav li a img {
    margin-right: 10px;
    /* Adds space to the right of the icons */
    flex-shrink: 0;
    /* Prevents the icon from shrinking */
}

h4.mb-0 {
    color: white;
    /* Set text color to white */
    font-size: 30px;
    /* Adjust the font size as per your preference */
    font-weight: bold;
    /* Make the font bold */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    /* Add a subtle shadow effect */
    letter-spacing: 2px;
    /* Add some letter spacing */
    text-transform: uppercase;
    /* Make the text uppercase */
}

.breadcrumb-item button {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    background-color: #4faef8;
    /* Cool blue background */
    border: none;
    /* Remove default button borders */
    border-radius: 10px;
    /* Rounded corners */
    color: white;
    /* White text */
    font-weight: bold;
    /* Make the text bold */
    font-size: 16px;
    /* Adjust font size */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Subtle shadow for 3D effect */
    cursor: pointer;
    /* Pointer cursor for interactivity */
    transition: background-color 0.3s, transform 0.2s;
    /* Smooth hover effects */
}

.breadcrumb-item button img {
    margin-right: 10px;
    /* Add space between the icon and text */
}

.breadcrumb-item button:hover {
    background-color: #3a8cc4;
    /* Slightly darker blue on hover */
    transform: scale(1.05);
    /* Slight zoom-in effect on hover */
}

.breadcrumb-item button:focus {
    outline: none;
    /* Remove focus outline */
}

/* Search form styling */
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
// Function to fetch counts from the server
function fetchCounts() {
    $.ajax({
        url: 'fetch_counts.php', // PHP file that returns the counts
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the total user count if greater than 0
            if (response.total_users_count > 0) {
                $('.total-users-badge').text(response.total_users_count);
            } else {
                $('.total-users-badge').text(''); // Hide the badge if count is 0
            }

            // Update the comment count (chat icon)
            if (response.comment_count > 0) {
                $('.comment-icon').show();
            } else {
                $('.comment-icon').hide();
            }

            // Update the low stock count
            if (response.lowStockCount > 0) {
                $('.low-stock-icon').show();
            } else {
                $('.low-stock-icon').hide();
            }
        },
        error: function(error) {
            console.log("Error fetching counts:", error);
        }
    });
}

// Call the function every 2 seconds to auto-refresh counts
setInterval(fetchCounts, 2000);
</script>
