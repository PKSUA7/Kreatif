var times = [];

function time(day, hour, minute, second, div)
	{
	this.day = day;
	this.hour = hour;
	this.minute = minute;
	this.second = second;
	this.div = document.getElementById(div);
	}

function addTime(day, hour, minute, second, div)
	{
	var newTime = new time(day, hour, minute, second, div);
	times.push(newTime);
	}

function initCountdown()
	{
	setInterval("countdown()", 1000);
	}

function countdown()
	{
	for (i=0;i<times.length;i++)
		{
		times[i].second--;
		if (times[i].second<0)
			{
			times[i].second=59;
			times[i].minute--;
			}
		if (times[i].minute<0)
			{
			times[i].minute=59;
			times[i].hour--;
			}
		if (times[i].hour<0)
			{
			times[i].hour=24;
			times[i].day--;
			}
		if (times[i].day<0)
			{
			times[i].div.innerHTML = "Udløbet";
			times.splice(i,1);
			i--;
			continue;
			}
		times[i].div.innerHTML = times[i].day + " dage, " +
				timeToString(times[i].hour,times[i].minute,times[i].second);
		}
	}

function timeToString(h,i,s)
	{
	time = "";
	if (h<10) {time+="0";}
	time+=h+":";
	if (i<10) {time+="0";}
	time+=i+":";
	if (s<10) {time+="0";}
	time+=s;
	return time;
	}
