export const formatDate = (date) => {
    return new Intl.DateTimeFormat("nl-NL", {
        year: 'numeric',
        month: '2-digit',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
    }).format(new Date(date));
}
