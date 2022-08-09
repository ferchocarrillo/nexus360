<div class="carousel-item">
    <div class="logo_top">
        <img src="\img\salesShow\logo_enercare.png" alt="">
    </div>
    <div class="line">
        <h1 class="lob">OVERNIGHT</h1>
    </div>
    <div class="card-deck">
        <div class="card">
            <h5 class="card-title">
                {{--  /*daily sales Over Night*/  --}}
                <span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
            </h5>
            <main class="grid">
                <article>
                    <div class="center">
                        <div class="card-1">
                            <div class="header-gold">Ranking 1</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOver1 }}
                                    <br>
                                    {{ $d_aOver1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">Ranking 3</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOver3 }}
                                    <br>
                                    {{ $d_aOver3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">Ranking 2</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOver2 }}
                                    <br>
                                    {{ $d_aOver2Count }}
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="listado_otros">
                    <div class="parent">
                        <div class="div1">
                            <label class="label_otros" for="">4</label><br>
                            <label class="label_otros" for="">5</label><br>
                            <label class="label_otros" for="">6</label><br>
                            <label class="label_otros" for="">7</label><br>
                            <label class="label_otros" for="">8</label>
                        </div>
                        <div class="div2">
                            <input class="otros-izq" type="text" value="{{ $d_aOver4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOver5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOver6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOver7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOver8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $d_aOver4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOver5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOver6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOver7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOver8Count }}">
                        </div>
                    </div>
                </article>
            </main>
            <article class="listado_super">
                <h5 class="card-title">
                    {{--  /*supervisor daily sales Over Night*/  --}}
                    <span>S</span><span>U</span><span>P</span><span>E</span><span>R</span><span>V</span><span>I</span><span>S</span><span>O</span><span>R</span>
                    <span>&nbsp;</span><span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span>
                </h5>
                <div class="parent">
                    <div class="div1a">
                        <label class="label_otros" for="">1</label><br>
                        <label class="label_otros" for="">2</label><br>
                        <label class="label_otros" for="">3</label>
                    </div>
                    <div class="div2a">
                        <input class="otros-izq" type="text" value="{{ $d_sOver1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOver2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOver3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $d_sOver1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOver2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOver3Count }}">
                    </div>
                </div>
            </article>
        </div>
        <div class="card">
            <h5 class="card-title">
                {{--  /*weekly sales Over Night*/  --}}
                <span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
            </h5>
            <main class="grid">
                <article>
                    <div class="center">
                        <div class="card-1">
                            <div class="header-gold">Ranking 1</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOver1 }}
                                    <br>
                                    {{ $w_aOver1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">Ranking 3</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOver3 }}
                                    <br>
                                    {{ $w_aOver3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">Ranking 2</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOver2 }}
                                    <br>
                                    {{ $w_aOver2Count }}
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="listado_otros">
                    <div class="parent">
                        <div class="div1">
                            <label class="label_otros" for="">4</label><br>
                            <label class="label_otros" for="">5</label><br>
                            <label class="label_otros" for="">6</label><br>
                            <label class="label_otros" for="">7</label><br>
                            <label class="label_otros" for="">8</label>
                        </div>
                        <div class="div2">
                            <input class="otros-izq" type="text" value="{{ $w_aOver4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOver5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOver6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOver7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOver8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $w_aOver4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOver5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOver6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOver7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOver8Count }}">
                        </div>
                    </div>
                </article>
            </main>
            <article class="listado_super">
                <h5 class="card-title">
                    {{--  /*weekly supervisor Over Nigth*/  --}}
                    <span>S</span><span>U</span><span>P</span><span>E</span><span>R</span><span>V</span><span>I</span><span>S</span><span>O</span><span>R</span>
                    <span>&nbsp;</span><span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span>
                </h5>
                <div class="parent">
                    <div class="div1a">
                        <label class="label_otros" for="">1</label><br>
                        <label class="label_otros" for="">2</label><br>
                        <label class="label_otros" for="">3</label>
                    </div>
                    <div class="div2a">
                        <input class="otros-izq" type="text" value="{{ $w_sOver1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOver2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOver3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $w_sOver1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOver2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOver3Count }}">
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
