<div class="row">
    <div class="col-md-6">
        <h3>Days</h3>
        {days}
            <!-- Default panel contents -->
            <div class="panel-heading">{dayofweek}</div>

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
        <h3>Periods</h3>
        {periods}
            <!-- Default panel contents -->
            <div class="panel-heading">{timeslot}</div>

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
        <h3>Courses</h3>
        {courses}
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">{title}</div>

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
            <input type="submit" name="submit" value="Search" />
        </form>
    </div>
</div>