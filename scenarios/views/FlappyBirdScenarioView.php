<div id="iaah_content">

    <?php 
        // https://www.w3schools.com/graphics/tryit.asp?filename=trygame_score 
    ?>

    <legend id="iaah_game_legend">Faites le plus grand score: </legend>
    <p id="iaah_game">
        <button onclick="startGame(); document.getElementById('iaah_game_start').remove(); return false;" id="iaah_game_start">Start</button>
    </p>
    <p id="iaah_game_instructions"></p>

    <input type="text" name="iaah_result" id="iaah_result" style="display:none;" />

    <style>
        canvas {
            border:1px solid #d3d3d3;
            background-color: #f1f1f1;
        }
    </style>
    
    <script>
        var myGamePiece;
        var myObstacles = [];
        var myScore;

        var goal = <?php echo $goal; ?>;

        function startGame() {
            myGamePiece = new component(30, 30, "red", 200, 120);
            myScore = new component("30px", "Consolas", "black", 280, 40, "text");
            myGameArea.start();
            myGameArea.canvas.setAttribute("id", "canvas");
        }

        function restartGame(){
            myGamePiece = new component(30, 30, "red", 200, 120);
            myScore = new component("30px", "Consolas", "black", 280, 40, "text");
            myGameArea.clear();
            myObstacles = [];
            myGameArea.start();
            myGameArea.canvas.setAttribute("id", "canvas");
        }

        var myGameArea = {
            canvas : document.createElement("canvas"),
            start : function() {
                    this.canvas.width = 480;
                    this.canvas.height = 270;
                    this.context = this.canvas.getContext("2d"); 
                    document.getElementById('iaah_game').insertBefore(this.canvas, document.getElementById('iaah_game').childNodes[0]);
                    document.getElementById('iaah_game_instructions').innerHTML = '';
                    this.frameNo = 0;
                    this.interval = setInterval(updateGameArea, 20);
                    registerEvents();
                },
            clear : function() {
                    this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
                },
            stop : function() {
                    clearInterval(this.interval);
                },
        }

        function component(width, height, color, x, y, type) {
            this.type = type;
            this.width = width;
            this.height = height;
            this.speedX = 0;
            this.speedY = 0;    
            this.x = x;
            this.y = y;    
            this.update = function() {
                ctx = myGameArea.context;
                if (this.type == "text") {
                    ctx.font = this.width + " " + this.height;
                    ctx.fillStyle = color;
                    ctx.fillText(this.text, this.x, this.y);
                } else {
                    ctx.fillStyle = color;
                    ctx.fillRect(this.x, this.y, this.width, this.height);
                }
            }
            this.newPos = function() {
                this.x += this.speedX;
                this.y += this.speedY;        
            }
            this.crashWith = function(otherobj) {
                var myleft = this.x;
                var myright = this.x + (this.width);
                var mytop = this.y;
                var mybottom = this.y + (this.height);
                var otherleft = otherobj.x;
                var otherright = otherobj.x + (otherobj.width);
                var othertop = otherobj.y;
                var otherbottom = otherobj.y + (otherobj.height);
                var crash = true;
                if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
                    crash = false;
                }
                return crash;
            }
        }

        function updateGameArea() {
            var x, height, gap, minHeight, maxHeight, minGap, maxGap;
            for (i = 0; i < myObstacles.length; i += 1) {
                if (myGamePiece.crashWith(myObstacles[i])) {
                    myGameArea.stop();
                    document.getElementById('canvas').remove();
                    document.getElementById('iaah_game_instructions').innerHTML = '<p>Vous avez échoué. Veuillez réessayer: <button onclick="restartGame(); return false;">Restart</button></p>';
                    document.getElementById('iaah_result').value  = myGameArea.frameNo;
                    return;
                } 
            }
            myGameArea.clear();
            myGameArea.frameNo += 1;
            if (myGameArea.frameNo == 1 || everyinterval(150)) {
                x = myGameArea.canvas.width;
                minHeight = 20;
                maxHeight = 200;
                height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
                minGap = 50;
                maxGap = 100;
                gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
                myObstacles.push(new component(10, height, "green", x, 0));
                myObstacles.push(new component(10, x - height - gap, "green", x, height + gap));
            }
            for (i = 0; i < myObstacles.length; i += 1) {
                myObstacles[i].speedX = -1;
                myObstacles[i].newPos();
                myObstacles[i].update();
            }
            myScore.text="SCORE: " + myGameArea.frameNo;
            myScore.update();
            myGamePiece.newPos();    
            myGamePiece.update();

            if(myGameArea.frameNo > goal){
                myGameArea.stop();
                document.getElementById('iaah_game_legend').remove();
                document.getElementById('canvas').remove();
                document.getElementById('iaah_game_instructions').innerHTML = '<p>Vous avez réussi.</p>';
                document.getElementById('iaah_result').value  = myGameArea.frameNo;
                return;
            }
        }

        function registerEvents(){
            document.addEventListener('keydown', function(e){
                switch(e.code){
                    case 'ArrowUp':
                        moveup();
                        break;
                    case 'ArrowDown':
                        movedown();
                        break;
                    case 'ArrowLeft':
                        moveleft();
                        break;
                    case 'ArrowRight':
                        moveright();
                        break;
                }
            });

            document.addEventListener('keyup', function(e){
                clearmove();
            });
        }

        function everyinterval(n) {
            if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
            return false;
        }

        function moveup() {
            myGamePiece.speedY = -1; 
        }

        function movedown() {
            myGamePiece.speedY = 1; 
        }

        function moveleft() {
            myGamePiece.speedX = -1; 
        }

        function moveright() {
            myGamePiece.speedX = 1; 
        }

        function clearmove() {
            myGamePiece.speedX = 0; 
            myGamePiece.speedY = 0; 
        }
    </script>


</div>