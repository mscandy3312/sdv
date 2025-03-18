<style>
.stat-card {
    border: none;
    background: linear-gradient(145deg, var(--pale-blue), white);
    border-radius: 15px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.1);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(145deg, var(--primary-blue), var(--dark-blue));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.chart-card {
    border: none;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(37, 99, 235, 0.05);
}

.chart-title {
    color: var(--dark-blue);
    font-weight: 600;
    padding: 1rem;
    border-bottom: 2px solid var(--pale-blue);
}

.trend-up {
    color: #10B981;
}

.trend-down {
    color: #EF4444;
}
</style> 