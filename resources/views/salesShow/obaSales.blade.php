<div class="carousel-item">
    <div class="logo_top">
        <img src="\img\salesShow\logo_enercare.png" alt="">
    </div>
    <div class="line">
        <h1 class="lob">OBA</h1>
    </div>
    <div class="card-deck">
        <div class="card">
            <h5 class="card-title">
                {{--  /*daily sales oba*/  --}}
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
                                    {{ $d_aOba1 }}
                                    <br>
                                    {{ $d_aOba1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">Ranking 3</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOba3 }}
                                    <br>
                                    {{ $d_aOba3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">Ranking 2</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOba2 }}
                                    <br>
                                    {{ $d_aOba2Count }}
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
                            <input class="otros-izq" type="text" value="{{ $d_aOba4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOba5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOba6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOba7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOba8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $d_aOba4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOba5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOba6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOba7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOba8Count }}">
                        </div>
                    </div>
                </article>
            </main>
            <article class="listado_super">
                <h5 class="card-title">
                    {{--  /*supervisor daily sales oba*/  --}}
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
                        <input class="otros-izq" type="text" value="{{ $d_sOba1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOba2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOba3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $d_sOba1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOba2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOba3Count }}">
                    </div>
                </div>
            </article>
        </div>
        <div class="card">
            <h5 class="card-title">
                {{--  /*weekly sales oba*/  --}}
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
                                    {{ $w_aOba1 }}
                                    <br>
                                    {{ $w_aOba1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">Ranking 3</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOba3 }}
                                    <br>
                                    {{ $w_aOba3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">Ranking 2</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOba2 }}
                                    <br>
                                    {{ $w_aOba2Count }}
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
                            <input class="otros-izq" type="text" value="{{ $w_aOba4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $w_aOba4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba8Count }}">
                        </div>
                    </div>
                </article>
            </main>
            <article class="listado_super">
                <h5 class="card-title">
                    {{--  /*weekly supervisor oba*/  --}}
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
                        <input class="otros-izq" type="text" value="{{ $w_sOba1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOba2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOba3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $w_sOba1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOba2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOba3Count }}">
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
