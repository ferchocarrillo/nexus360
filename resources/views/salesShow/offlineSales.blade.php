<div class="carousel-item">
    <div class="logo_top">
        <img src="\img\salesShow\logo_enercare.png" alt="">
    </div>
    <div class="line">
        <h1 class="lob">OFFLINE</h1>
    </div>
    <div class="card-deck">
        <div class="card">
            <h5 class="card-title">
                {{--  /*dialy sales offline*/  --}}
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
                                    {{ $d_aOff1 }}
                                    <br>
                                    {{ $d_aOff1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">Ranking 3</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOff3 }}
                                    <br>
                                    {{ $d_aOff3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">Ranking 2</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOff2 }}
                                    <br>
                                    {{ $d_aOff2Count }}
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
                            <input class="otros-izq" type="text" value="{{ $d_aOff4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOff5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOff6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOff7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $d_aOff8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $d_aOff4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOff5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOff6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOff7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $d_aOff8Count }}">
                        </div>
                    </div>
                </article>
            </main>
            <article class="listado_super">
                <h5 class="card-title">
                    {{--  /*dialy supervisor offline*/  --}}
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
                        <input class="otros-izq" type="text" value="{{ $d_sOff1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOff2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOff3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $d_sOff1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOff2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOff3Count }}">
                    </div>
                </div>
            </article>
        </div>
        <div class="card">
            <h5 class="card-title">
                <span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
                {{--  /*weekly sales offline*/  --}}
            </h5>
            <main class="grid">
                <article>
                    <div class="center">
                        <div class="card-1">
                            <div class="header-gold">Ranking 1</div>
                            <div class="content">
                                <p>
                                    {{$w_aOff1}}
                                    <br>
                                    {{$w_aOff1Count}}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">Ranking 3</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOff3 }}
                                    <br>
                                    {{ $w_aOff3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">Ranking 2</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOff2 }}
                                    <br>
                                    {{ $w_aOff2Count }}
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
                            <input class="otros-izq" type="text" value="{{ $w_aOff4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOff5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOff6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOff7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOff8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $w_aOff4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOff5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOff6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOff7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOff8Count }}">
                        </div>
                    </div>
                </article>
            </main>
            <article class="listado_super">
                <h5 class="card-title">
                    {{--  /*weekly suupervisor offline*/  --}}
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
                        <input class="otros-izq" type="text" value="{{ $w_sOff1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOff2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOff3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $w_sOff1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOff2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOff3Count }}">
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
