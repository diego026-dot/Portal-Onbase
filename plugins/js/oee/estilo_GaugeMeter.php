<style>
            .GaugeMeter{
                Position: Relative;
                Text-Align: Center;
                Overflow: Hidden;
                Cursor: Default;
            }

            .GaugeMeter SPAN,
            .GaugeMeter B{
                Margin:	0 23%;
                Width: 54%;
                Position: Absolute;
                Text-Align: Center;
                Display: Inline-Block;
                Color: RGBa(0,0,0,.8);
                Font-Weight: 100;
                Font-Family: "Open Sans", Arial;
                Overflow: Hidden;
                White-Space: NoWrap;
                Text-Overflow: Ellipsis;
            }
            .GaugeMeter[data-style="Semi"] B{
                Margin: 0 10%;
                Width: 80%;
            }

            .GaugeMeter S,
            .GaugeMeter U{
                Text-Decoration:None;
                Font-Size: .60em;
                Font-Weight: 200;
                Opacity: .6;
            }

            .GaugeMeter B{
                Color: Black;
                Font-Weight: 200;
                Font-Size: 0.85em;
                Opacity: .8;
            }
            PRE{
                Background: RGBa(0,0,0,.05);
                Padding: 15px;
                Border-Radius: 10px;
                Position: Relative;
                Width: 350px;
                Float: Left;
                Font-Weight: 100;
                Letter-Spacing: -1px;
                Margin: 0 10px 10px 30px;
            }

           

            DIV.GaugeMeter{
                Float: Left;
            }

           

            P{
                Font: Normal 100 15px/15px Arial;
                Color: Black;
                Margin-Bottom: 20px;
                Margin-Left: 20px;
            }


            
            

            PRE.Code{
                Letter-Spacing: 0;
                Width: Auto;
                Width: calc(100vw - 70px);
                Color: #6AA121;
                Float: None;
                Font-Size: 13px;
                Line-Height: 20px;
                Margin-Bottom: 50px;
                Margin-Left: 30px;

                Border-Left: 4px Solid #2C94E0;
                Border-Radius: 1px 10px 10px 1px;
                Padding: 0 10px 0 0;
                Background-Image: Linear-Gradient(Transparent 50%, RGBa(255,255,255,.6) 50%);
                Background-Size: 40px 40px;
                Counter-Reset: Line-Numbering;
                Word-Break: Break-Word;
            }
            PRE.Code .Line::before{
                Content: Counter(Line-Numbering);
                Counter-Increment: Line-Numbering;
                Min-Width: 3em;
                Padding-Right: 1em;
                Margin-Right: 1em;
                Display: Inline-Block;
                Text-Align: Right;
                Color: RGBa(44,148,224,.7);
                Border-Right: 1px Solid #2C94E0;
                Background: RGBa(44,148,224,.04);
                -webkit-touch-callout: None;
                -webkit-user-select: None;
                -khtml-user-select: None;
                -moz-user-select: None;
                -ms-user-select: None;
                user-select: None;
            }

           

            @-moz-keyframes BluePrint{
                0% {Background-Position: 0 0;}
                100% {Background-Position: 1100% 100%;}
            }

            @-webkit-keyframes BluePrint{
                0% {Background-Position: 0 0;}
                100% {Background-Position: 1100% 100%;}
            }

            @keyframes BluePrint{
                0% {Background-Position: 0 0;}
                100% {Background-Position: -100% 100%;}
            }

            HEADER H1{
                Color: White;
                Font: Normal 400 28px/28px "Helvetica", Arial;
                Margin: 30px Auto 20px Auto;
                Text-Shadow: 0 2px 10px rgba(0,0,0,.3);
            }

            HEADER P{
                Color: White;
                Font: Normal 200 18px/22px "Helvetica", Arial;
                Margin: 0 Auto;
                Text-Shadow: 0 1px 5px rgba(0,0,0,.3);
            }
            

            .Hide {
                Display: None;
            }
            DIV.StickyHeader{
                Position: Fixed;
                Top: 0;
            }
            DIV.StickyHeader TABLE{
                Border-Bottom: None;
            }

           
            .Ribbon{
                Background: #a90329;
                Background: -moz-linear-gradient(top, #a90329 0%, #6d0019 100%);
                Background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a90329), color-stop(100%,#6d0019));
                Background: -webkit-linear-gradient(top, #a90329 0%,#6d0019 100%);
                Background: -o-linear-gradient(top, #a90329 0%,#6d0019 100%);
                Background: -ms-linear-gradient(top, #a90329 0%,#6d0019 100%);
                Background: linear-gradient(to bottom, #a90329 0%,#6d0019 100%);
                Border: 1px Dashed RGBa(255,255,255,.2);
                Box-shadow: 0 1px 10px RGBa(0,0,0,.6);
                Font: Normal 800 10px "Open Sans", Arial;
                Top: 3.2em;
                Right: -3.7em;
                Color: White;
                Display: Block;
                Padding: .6em 3.5em;
                Position: Fixed;
                z-Index: 100;
                Text-Align: Center;
                Text-Decoration: None;
                -webkit-transform: rotate(45deg);
                -moz-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                -o-transform: rotate(45deg);
                transform: rotate(45deg);
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -o-user-select: none;
                user-select: none;
            }
            .Ribbon:Hover{
                Background: #000;
            }
        </style>