<div class="row">
    <div class="col-md-6">
        <h2 style="text-decoration: underline">Days</h2>
        {days}
            <!-- Default panel contents -->
            <h3><div class="panel-heading">{dayofweek}</div></h3>

            <table class="table">
                <tr>
                    <th>Time</th>
                    <th>Course</th>
                    <th>Type</th>
                    <th>Building</th>
                    <th>Room</th>
                    <th>Instructor</th>
                </tr>
                {bookings}
                <tr>
                    <td>{timeslot}</td>
                    <td>{cname}</td>
                    <td>{type}</td>
                    <td>{building}</td>
                    <td>{roomNum}</td>
                    <td>{instructor}</td>
                </tr>
                {/bookings}
            </table>
        {/days}
    </div>
    <div class="col-md-6">
        <h2 style="text-decoration: underline">Periods</h2>
        {periods}
            <!-- Default panel contents -->
            <h3><div class="panel-heading">{timeslot}</div></h3>

            <table class="table">
                <tr>
                    <th>Day</th>
                    <th>Course</th>
                    <th>Type</th>
                    <th>Building</th>
                    <th>Room</th>
                    <th>Instructor</th>
                </tr>
                {bookings}
                <tr>
                    <td>{day}</td>
                    <td>{cname}</td>
                    <td>{type}</td>
                    <td>{building}</td>
                    <td>{roomNum}</td>
                    <td>{instructor}</td>
                </tr>
                {/bookings}
            </table>
        {/periods}
    </div>
    <div class="col-md-6">
        <h2 style="text-decoration: underline">Courses</h2>
        {courses}
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <h3><div class="panel-heading">{title}</div></h3>

            <table class="table">
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Building</th>
                    <th>Room</th>
                    <th>Instructor</th>
                </tr>
                {bookings}
                <tr>
                    <td>{day}</td>
                    <td>{timeslot}</td>
                    <td>{type}</td>
                    <td>{building}</td>
                    <td>{roomNum}</td>
                    <td>{instructor}</td>
                </tr>
                {/bookings}
            </table>
        </div>
        {/courses}
    </div>
    <div class="col-md-6">
        <h3>Search</h3>
        <form action="/welcome/search" method="post" accept-charset="utf-8">
            <h4>Day: {day_dropdown}</h4>
            <h4>Time: {time_dropdown}</h4>
            <input type="submit" name="submit" value="Not Working" />
        </form>
    </div>
<!--    <div class="col-md-6">-->
<!--        <h3>{error}</h3>-->
<!--    </div>-->
<!--    <div class="col-md-6">-->
<!--        <h3>{bingo}</h3>-->
<!--        <p>{results}</p>-->
<!--    </div>-->
</div>