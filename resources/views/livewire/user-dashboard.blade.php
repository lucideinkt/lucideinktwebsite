<div class="dashboard-overview">
    <div class="overview-grid">
        <div class="overview-card">
            <div class="card-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="card-info">
                <h3>Mijn Profiel</h3>
                <p>Beheer je gegevens en wachtwoord.</p>
                <a href="{{ route('editProfile') }}" class="btn-dashboard">Profiel aanpassen</a>
            </div>
        </div>

        <div class="overview-card">
            <div class="card-icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="card-info">
                <h3>Mijn Bestellingen</h3>
                <p>Bekijk je eerdere bestellingen en hun status.</p>
                <a href="{{ route('showMyOrders') }}" class="btn-dashboard">Bestellingen inzien</a>
            </div>
        </div>

        <div class="overview-card">
            <div class="card-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="card-info">
                <h3>Online Bibliotheek</h3>
                <p>Lees direct je aangeschafte boeken online.</p>
                <a href="{{ route('onlineLezen') }}" class="btn-dashboard">Naar bibliotheek</a>
            </div>
        </div>
    </div>
</div>
