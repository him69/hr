@include('admin.includes.header')
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>

<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('admin.includes.top_nav')
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">
            </div>
        </div>
    </div>
    <div class="app-main overflow-hidden">
        @include('admin.includes.sidebar')
        <div class="app-main__outer collapse">
            <div class="app-main__inner mt-4">
                <canvas id="orgchart" style="border:1px solid #000000; width: calc( 100vw - 110px);">
                </canvas>
            </div>
        </div>
    </div>
    @include('admin.includes.footer')
    <script>
        function drawRoundedRect(ctx, x, y, width, height, borderRadius) {
            if (width < 2 * borderRadius) borderRadius = width / 2;
            if (height < 2 * borderRadius) borderRadius = height / 2;
            ctx.beginPath();
            ctx.moveTo(x + borderRadius, y);
            ctx.arcTo(x + width, y, x + width, y + height, borderRadius);
            ctx.arcTo(x + width, y + height, x, y + height, borderRadius);
            ctx.arcTo(x, y + height, x, y, borderRadius);
            ctx.arcTo(x, y, x + width, y, borderRadius);
            ctx.closePath();
            ctx.stroke();
        }
        var dpr = window.devicePixelRatio || 1;
        var allu = document.getElementById('orgchart');
        var ctx = allu.getContext('2d')
        var rect = allu.getBoundingClientRect();
        allu.width = rect.width * dpr;
        allu.height = rect.height * dpr;
        ctx.scale(dpr, dpr);
        // reactangle
        var recWidth = 200;
        var recHeight = 50;
        var xPos = (rect.height) - (recWidth / 2);
        var yPos = 40;
        ctx.strokeStyle = '#4c4b46'; // border
        var borderRadius = 3;
        ctx.lineWidth = 1;
        drawRoundedRect(ctx, xPos, yPos, recWidth, recHeight, borderRadius);
        // text
        var Designation = "CEO"
        var username = "Ashuthosh Kumar"
        var textMeasure1 = ctx.measureText(Designation);
        var textMeasure2 = ctx.measureText(username);
        var textWidth = textMeasure1.width;
        var textWidth2 = textMeasure2.width;
        var textHeight = textMeasure1.actualBoundingBoxAscent + textMeasure1.actualBoundingBoxDescent;
        var textX1 = xPos + (recWidth / 2) - textWidth + 10
        var textX2 = xPos + (recWidth / 2) - textWidth2 + 10
        console.log(textWidth)
        var textY = yPos + (recHeight / 2) + textHeight + 5;
        var textY2 = yPos + (recHeight / 2) - 3;
        ctx.font = '14px Arial'
        ctx.fillStyle = "black"
        ctx.fillText(Designation, textX1, textY)
        ctx.font = '16px Arial'
        ctx.fillText(username, textX2, textY2)
        // depart ment lines
        var lineStartX = xPos + recWidth /2;
        var lineStartY = yPos + recHeight ;

        // End point for the line moving downward
        var lineEnd1X = lineStartX ; 
        var lineEnd1Y = lineStartY + 100;
         
        var stLineX = recWidth /2
        var stLiney = lineEnd1Y
        var StLineEndX = rect.width - recWidth /2
        var StLineEndy =lineEnd1Y
        // var lineEnd2X = lineStartX + 100;
        // var lineEnd2Y = lineStartY; // Straight right

        var lineEnd3X = lineStartX + 100;
        var lineEnd3Y = lineStartY + 50; // Downward

        // Draw lines
        ctx.beginPath();
        // ctx.moveTo(stLineX,stLiney)
        // ctx.arcTo(100, 20, 30, 400, 3);

// To visually complete the path, you might want to draw a line to the arc's end point
// ctx.lineTo(30, 400);
        ctx.moveTo(lineStartX, lineStartY);
        ctx.lineTo(lineEnd1X, lineEnd1Y); // Line 1

        ctx.moveTo(stLineX, stLiney);
        ctx.lineTo(StLineEndX, StLineEndy);
        ctx.closePath();
        ctx.stroke();

        function drawSmallLine(x, y, angle) {
    var length = 20; // Length of the small line
    ctx.save(); // Save the current context state
    ctx.translate(x, y); // Move to the corner position
    ctx.rotate(angle); // Rotate the context
    ctx.beginPath();
    ctx.moveTo(0, 0);
    ctx.lineTo(length, 0); // Draw the small line
    ctx.stroke();
    ctx.restore(); // Restore the context state
}

// Draw small lines at each corner of the horizontal line
// The angles are in radians. For example, Math.PI / 2 is 90 degrees
drawSmallLine(stLineX, stLiney, Math.PI / 2); // Left end, pointing down
drawSmallLine(stLineX, stLiney, -Math.PI / 2); // Left end, pointing up
drawSmallLine(stLineEndX, stLiney, Math.PI / 2); // Right end, pointing down
drawSmallLine(stLineEndX, stLiney, -Math.PI / 2); 
    </script>